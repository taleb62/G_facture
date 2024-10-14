const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");
const c_name = document.querySelector("#c_name");
const c_id = document.querySelector("#c_id");


const optionsList = document.querySelectorAll(".option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
    c_name.value = selected.textContent;
    c_id.value = o.getAttribute("c_id");
    
  });
});




