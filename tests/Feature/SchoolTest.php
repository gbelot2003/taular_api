<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Classes;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_teacher_can_have_multiple_classes()
    {
        $teacher = Teacher::factory()->create();
        $classes = Classes::factory()->count(3)->create(['teacher_id' => $teacher->id]);

        $this->assertCount(3, $teacher->classes);
    }

    /** @test */
    public function a_student_can_be_enrolled_in_multiple_classes()
    {
        $student = Student::factory()->create();
        $classes = Classes::factory()->count(2)->create();

        $student->classes()->attach($classes);

        $this->assertCount(2, $student->classes);
    }

    /** @test */
    public function a_schedule_can_be_assigned_to_a_class_and_grade()
    {
        $schedule = Schedule::factory()->create();

        $this->assertDatabaseHas('schedules', ['id' => $schedule->id]);
    }
}
