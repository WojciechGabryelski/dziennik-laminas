const course_select = document.getElementById('course-select');
const student_select = document.getElementById('student-select');

course_select.onchange = () => {
    while (student_select.options.length > 0) {
        student_select.remove(0);
    }
    student_select.add(new Option('Select student', null, true, true));
    if (typeof courses[course_select.value] !== 'undefined') {
        courses[course_select.value]['students'/*'studentsCourse'*/].forEach((student/*studentCourse*/) => {
            //let student = studentCourse['student'];
            student_select.add(new Option(student['firstName'] + ' ' + student['lastName'], student['id']));
        });
    }
};