/*
 * Send GET Request to
 * http://classshow.azad.ac.ir/Guest/GetCourseList?reshtehCode=xxx
 * and run the following code
 */

 function getCoursesOfField($fieldId) {
    const URL = 'http://classshow.azad.ac.ir/Guest/GetCourseList?reshtehCode=';
    let container = $('<div></div>'),
        coursesArr = [];
    $.get(
        URL + $fieldId,
        function(response, status) {
            container.html(response);
            $('#CourseId option', container).each((key, course) => {
                coursesArr.push(
                    {
                        'id': course.getAttribute('value'),
                        'name': course.innerText.trim(),
                        'fieldId': $fieldId
                    }
                );
            });
        }
    );
    return coursesArr;
 }
