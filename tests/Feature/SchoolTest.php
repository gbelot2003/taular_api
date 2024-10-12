<?php

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function a_user_with_role_maestro_can_be_assigned_as_teacher()
    {
        $user = User::factory()->maestro()->create();  // Asignar rol maestro
        $teacher = Teacher::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->hasRole('maestro'));
        $this->assertEquals($user->id, $teacher->user_id);
    }

    /** @test */
    public function a_user_with_role_alumno_can_be_assigned_as_student()
    {
        $user = User::factory()->alumno()->create();  // Asignar rol alumno
        $student = Student::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->hasRole('alumno'));
        $this->assertEquals($user->id, $student->user_id);
    }

    /** @test */
    public function a_class_can_have_multiple_students_assigned()
    {
        $class = Classes::factory()->create();
        $students = Student::factory()->count(3)->create();

        $class->students()->attach($students);

        $this->assertCount(3, $class->students);
    }

    /** @test */
    public function a_schedule_can_be_assigned_to_a_class_and_grade()
    {
        $schedule = Schedule::factory()->create();

        $this->assertDatabaseHas('schedules', ['id' => $schedule->id]);
    }

    /** @test */
    public function a_teacher_can_have_multiple_classes()
    {
        $teacher = Teacher::factory()->create();
        $classes = Classes::factory()->count(3)->create(['teacher_id' => $teacher->id]);

        $this->assertCount(3, $teacher->classes);
    }
}
