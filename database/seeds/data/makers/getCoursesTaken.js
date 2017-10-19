/**
 * @template http://enroll.azad.ac.ir/pages/emtehan/frm_studenkarnama.aspx
 */
let tables = document.querySelectorAll('table[id^=RepeaterYearSemester]'),
    coursesTaken = [];
const EMPTY = " ";
tables.forEach((table) => {
    let rows = table.children[0].children;
    for (let i = 1; i < rows.length; i++) {
        let columns = rows.item(i).children,
            score = columns[5].innerText === EMPTY ? null : columns[5].innerText,
            description = columns[6].innerText === EMPTY ? null : columns[6].innerText;
        coursesTaken.push({'course_code': columns[0].innerText, 'score': score, 'description': description });
    }
});

console.save(JSON.stringify(coursesTaken), 'coursesTaken.json');