var output = document.querySelector('.BlockOut');

function SearchClick() {
    
    //Находим и удаляем старые результаты поиска
    delElem = document.getElementById("OutputInfo");
    if (delElem) 
        document.getElementById("OutputInfo").remove();

    //Запоминаем новые результаты поиска
    let text = document.getElementById("input_form").value;

    //Проверка на 3 символа
    if (text.length < 3) {
        alert('Ввидите не менее 3-х символов')
    } else {
        //Передаем данные для поиска скрипты PHP
        let Jdata = JSON.stringify(text); 

        $.ajax({
            type: "POST",
            url: "Search.php",
            data: {myData: Jdata},
            success: function(data) {
                //Если поиск все успешно, то выводим новые данные на страницу
                //Страница не обновляется
                text = data;
                let Search = document.createElement('div');
                Search.setAttribute("id", "OutputInfo")
                Search.innerHTML = text;
                output.after(Search);
            },
            error: function() {
            console.log('error');
            }
        });
    }

}