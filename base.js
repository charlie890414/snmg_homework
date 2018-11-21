function edit(id){
    window.scrollTo(0, document.body.scrollHeight);
    var label = document.createElement("label");
    var div =  document.createElement("div");
    var input = document.createElement("input");
    var form = document.getElementById("form");
    label.style = "display:inline-block;";
    label.innerText = "編輯: ";
    input.id ="id";
    input.type = "text";
    input.name="edit";
    input.className="round";
    input.innerText = id;
    input.value = id;
    input.disabled = true;
    div.appendChild(input);
    form.insertBefore(div,form.childNodes[0]);
    form.insertBefore(label,form.childNodes[0]);
}

function edit(id){
    window.scrollTo(0, document.body.scrollHeight);
    var label = document.createElement("label");
    var div =  document.createElement("div");
    var input1 = document.createElement("input");
    var input2 = document.createElement("input");
    var form = document.getElementById("form");
    label.style = "display:inline-block;";
    label.innerText = "編輯: ";
    input1.id ="id";
    input1.type = "text";
    input1.name="edit";
    input1.className="round";
    input1.innerText = id;
    input1.value = id;
    input1.disabled = true;
    input2.id ="id";
    input2.type = "hidden";
    input2.name="edit";
    input2.className="round";
    input2.innerText = id;
    input2.value = id;
    div.appendChild(input1);
    div.appendChild(input2);
    form.insertBefore(div,form.childNodes[0]);
    form.insertBefore(label,form.childNodes[0]);
}