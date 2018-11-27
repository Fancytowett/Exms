<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\User::truncate();
//        \App\Exam::truncate();
//        \App\Darasa::truncate();
//        \App\Subject::truncate();
//        \App\Term::truncate();
//        \App\Stream::truncate();


        \App\User::create(['name'=>'Fancy','password'=>bcrypt('123456'),'email'=>'fancytowett@gmail.com',]);
        \App\Subject::create(['name'=>'English','short_name'=>'Eng']);
        \App\Subject::create(['name'=>'Mathematics','short_name'=>'Math']);
        \App\Subject::create(['name'=>'Kiswahili','short_name'=>'Swa']);

        \App\Darasa::create(['name'=>'Form One']);
        \App\Darasa::create(['name'=>'Form Two']);
        \App\Darasa::create(['name'=>'Form Three']);
        \App\Darasa::create(['name'=>'Form Four']);

        \App\Stream::create(['name'=>'East']);
        \App\Stream::create(['name'=>'West']);
        \App\Stream::create(['name'=>'North']);
        \App\Stream::create(['name'=>'South']);

        \App\Term::create(['name'=>'Term One']);
        \App\Term::create(['name'=>'Term Two']);
        \App\Term::create(['name'=>'Term Three']);

        \App\Exam::create(['name'=>'CAT1','class_id'=>1,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'CAT2','class_id'=>1,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'Main','class_id'=>1,'term_id'=>2,'year'=>'2018']);

        \App\Exam::create(['name'=>'CAT1','class_id'=>2,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'CAT2','class_id'=>2,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'Main','class_id'=>2,'term_id'=>2,'year'=>'2018']);

        \App\Exam::create(['name'=>'CAT1','class_id'=>3,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'CAT2','class_id'=>3,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'Main','class_id'=>3,'term_id'=>2,'year'=>'2018']);


        \App\Exam::create(['name'=>'CAT1','class_id'=>4,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'CAT2','class_id'=>4,'term_id'=>2,'year'=>'2018']);
        \App\Exam::create(['name'=>'Main','class_id'=>4,'term_id'=>2,'year'=>'2018']);


        \App\Student::create(['phone'=>'0708733074','adm_no'=>'345','fname'=>'Mary','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'1','stream_id'=>'2']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'347','fname'=>'John','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'2','stream_id'=>'2']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'360','fname'=>'Mercy','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'3','stream_id'=>'2']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'361','fname'=>'June','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'4','stream_id'=>'2']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'348','fname'=>'Jane','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'1','stream_id'=>'1']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'349','fname'=>'Davie','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'2','stream_id'=>'1']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'350','fname'=>'Simo','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'3','stream_id'=>'1']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'351','fname'=>'Kevin','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'4','stream_id'=>'1']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'352','fname'=>'Venn','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'1','stream_id'=>'3']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'353','fname'=>'Aloy','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'2','stream_id'=>'3']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'354','fname'=>'Mary','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'3','stream_id'=>'3']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'355','fname'=>'John','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'4','stream_id'=>'3']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'356','fname'=>'Mary','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'1','stream_id'=>'4']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'357','fname'=>'John','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'2','stream_id'=>'4']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'358','fname'=>'Mary','mname'=>'chege','lname'=>'Kawira','year'=>'2018','class_id'=>'3','stream_id'=>'4']);
        \App\Student::create(['phone'=>'0708733074','adm_no'=>'359','fname'=>'John','mname'=>'Moses','lname'=>'Njeri','year'=>'2018','class_id'=>'4','stream_id'=>'4']);

      \App\Guardian::create(['fname'=>'Esther','lname'=>'Korir','phone1'=>'0722345456','phone2'=>'0714356789']);
      \App\Guardian::create(['fname'=>'Linah','lname'=>'Mutai','phone1'=>'0756453454','phone2'=>'0721345456']);
//      \App\Student_subject::create()

    }
}
