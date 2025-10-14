<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class CoursesChart extends ChartWidget
{
    protected static ?string $heading = 'Enrollments Growth';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = auth()->user();

        // Get enrollments per day for the last 30 days
        $enrollmentsData = Enrollment::select(
            DB::raw('DATE(enrolled_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->when($user->isInstructor(), function ($query) use ($user) {
                // Instructor: only enrollments in their courses
                $query->whereHas('course', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->where('enrolled_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date'); // Key by date for easy lookup

        // Generate labels and data for the last 30 days
        $labels = [];
        $data = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('M d');

            // Find count for this day
            $data[] = $enrollmentsData->get($date)->count ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Enrollments',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}