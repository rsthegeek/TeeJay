var classHtml = document.querySelectorAll('.GridItem, .AlternatingItem, .GridRowSelected');

var classes = [];

classHtml.forEach(function (row) {
    let columns = row.children;

    classes.push({
        'courseCode': parseInt(columns[0].innerText.trim()),
        'name': columns[2].innerText.trim(),
        'practical_unit_count': parseInt(columns[4].innerText.trim()),
        'theoretical_unit_count': parseInt(columns[5].innerText.trim()),

        'teacherName': columns[3].innerText.trim(),

        'code': columns[1].innerText.trim(),
        'firstTime': columns[6].innerText.trim(),
        'secondTime': columns[7].innerText.trim(),
        'thirdTime': columns[8].innerText.trim(),
        'examTime': columns[9].innerText.trim(),
        'examDate': columns[11].innerText.trim(),
        'remainingCap': parseInt(columns[10].innerText.trim()),
        'boysCount': parseInt(columns[12].innerText.trim()),
        'girlsCount': parseInt(columns[13].innerText.trim()),
        'allowedGender': columns[14].innerText.trim(),
        'status15': columns[15].innerText.trim() == 'True' ? true : false,
        'status17': columns[17].innerText.trim() == 'True' ? true : false,
        'place': columns[16].innerText.trim(),//.replace(/^\s+|\s+$/gm, '')
        'fromYear': parseInt(columns[18].innerText.trim()),
        'toYear': parseInt(columns[19].innerText.trim()),
        'field': columns[20].innerText.trim(),
    });
});

// function console.save() ...

// console.save(JSON.stringify(classes), 'classes.json');
