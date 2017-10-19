let fieldsArr = [],
    fields = document.getElementsByName('GroupId')[0].children;
for (let i = 0; i < fields.length; i++) {
    fieldsArr.push(
        {
            'id': fields.item(i).getAttribute('value'),
            'title': fields.item(i).innerText.trim()
        }
    );
}

console.save(JSON.stringify(fieldsArr), 'fields.class-show.json');
