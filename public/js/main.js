const checkBoxes = document.querySelectorAll('input[type=checkbox]');

checkBoxes.forEach(checkbox=>{
    checkbox.addEventListener('change',()=>{
        checkbox.parentNode.submit();
    });
});

const deletes = document.querySelectorAll('.delete');

deletes.forEach(span=>{
    span.addEventListener('click',()=>{
        span.parentNode.submit();
    });
});