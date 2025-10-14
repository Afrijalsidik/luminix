<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Chapter;
use App\Models\Category;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        // Jika Instructor, hanya tampilkan statistik kursus mereka
        if ($user->isInstructor()) {
            $totalCourses = Course::where('user_id', $user->id)->count();
            $publishedCourses = Course::where('user_id', $user->id)->where('status', 'published')->count();
            $totalChapters = Chapter::whereHas('course', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $totalEnrollments = Enrollment::whereHas('course', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $activeEnrollments = Enrollment::whereHas('course', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'active')->count();
            $completedEnrollments = Enrollment::whereHas('course', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'completed')->count();

            return [
                Stat::make('My Courses', $totalCourses)
                    ->description($publishedCourses . ' published')
                    ->descriptionIcon('heroicon-o-academic-cap')
                    ->color('success')
                    ->chart([7, 12, 16, 18, 20, 22, $totalCourses]),

                Stat::make('Total Chapters', $totalChapters)
                    ->description('In my courses')
                    ->descriptionIcon('heroicon-o-book-open')
                    ->color('info'),

                Stat::make('Total Students', $totalEnrollments)
                    ->description($activeEnrollments . ' active, ' . $completedEnrollments . ' completed')
                    ->descriptionIcon('heroicon-o-users')
                    ->color('warning'),

                Stat::make('Completion Rate', $totalEnrollments > 0 ? round(($completedEnrollments / $totalEnrollments) * 100) . '%' : '0%')
                    ->description('Students who completed')
                    ->descriptionIcon('heroicon-o-chart-bar')
                    ->color($totalEnrollments > 0 && ($completedEnrollments / $totalEnrollments) > 0.5 ? 'success' : 'warning'),
            ];
        }

        // Admin - Statistik global
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        $totalCourses = Course::count();
        $publishedCourses = Course::where('status', 'published')->count();
        $draftCourses = Course::where('status', 'draft')->count();

        $totalCategories = Category::count();
        $totalChapters = Chapter::count();

        $totalEnrollments = Enrollment::count();
        $activeEnrollments = Enrollment::where('status', 'active')->count();
        $completedEnrollments = Enrollment::where('status', 'completed')->count();

        $averageProgress = Enrollment::avg('progress_percentage');

        return [
            // Row 1: Users
            Stat::make('Total Users', $totalUsers)
                ->description("Students: {$totalStudents} | Instructors: {$totalInstructors} | Admins: {$totalAdmins}")
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->chart([10, 15, 25, 40, 55, 70, $totalUsers]),

            Stat::make('Total Students', $totalStudents)
                ->description('Registered students')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('info'),

            Stat::make('Total Instructors', $totalInstructors)
                ->description('Active instructors')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('warning'),

            // Row 2: Courses
            Stat::make('Total Courses', $totalCourses)
                ->description("Published: {$publishedCourses} | Draft: {$draftCourses}")
                ->descriptionIcon('heroicon-o-book-open')
                ->color('primary')
                ->chart([5, 10, 15, 20, 25, 30, $totalCourses]),

            Stat::make('Published Courses', $publishedCourses)
                ->description('Available to students')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Total Categories', $totalCategories)
                ->description('Course categories')
                ->descriptionIcon('heroicon-o-tag')
                ->color('primary'),

            // Row 3: Enrollments & Engagement
            Stat::make('Total Enrollments', $totalEnrollments)
                ->description("Active: {$activeEnrollments} | Completed: {$completedEnrollments}")
                ->descriptionIcon('heroicon-o-clipboard-document-check')
                ->color('warning')
                ->chart([10, 25, 40, 60, 80, 100, $totalEnrollments]),

            Stat::make('Completion Rate', $totalEnrollments > 0 ? round(($completedEnrollments / $totalEnrollments) * 100) . '%' : '0%')
                ->description('Courses completed by students')
                ->descriptionIcon('heroicon-o-trophy')
                ->color($totalEnrollments > 0 && ($completedEnrollments / $totalEnrollments) > 0.5 ? 'success' : 'danger'),

            Stat::make('Average Progress', round($averageProgress, 1) . '%')
                ->description('Overall student progress')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color($averageProgress > 50 ? 'success' : 'warning'),

        ];
    }

    protected function getColumns(): int
    {
        return 3; // 3 kolom per row
    }
}