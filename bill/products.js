
// $id=>[0]-$name=>[1]-$qnt=>[2]-$catagorie=>[3]-$price=>[4]-$image=>[5]

let products1 = document.querySelectorAll(".infos");

let products = [];

products1.forEach( (e) => {
    let infos = e.textContent.split("@");
    let product ={
    id: infos[0],
    name: infos[1],
    price: +infos[4],
    instock: +infos[2],
    catagorie:infos[3],
    imgSrc: infos[5]
    };
    products.push(product);

});

console.log(products)

