<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register alias middleware
        $middleware->alias([
            'enrolled' => \App\Http\Middleware\CheckEnrolled::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (Throwable $e) {
            // --- Kirim ke log ---
            Log::error('Terjadi error!', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            $url = request()->fullUrl() ?? 'URL tidak dapat diambil';
            $user = auth()->check() ? auth()->user()->name : 'Guest';

            $message = "🚨 Error di Aplikasi Luminix\n\n"
                . "🧾 Pesan: " . $e->getMessage() . "\n"
                . "📁 File: " . $e->getFile() . "\n"
                . "🔢 Line: " . $e->getLine() . "\n"
                . "🌐 URL: " . $url . "\n"
                . "👤 User: " . $user;

            try {
                $botToken = config('services.telegram.bot_token');
                $chatId = config('services.telegram.chat_id');

                $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $message,

                ]);

                if (!$response->successful()) {
                    Log::warning('Gagal kirim error ke Telegram: ' . $response->body());
                }

            } catch (\Exception $ex) {
                Log::warning('Gagal kirim error ke Telegram: ' . $ex->getMessage());
            }
        });
    })
    ->create();
