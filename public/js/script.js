const recetas = [
  {
    nombre: "Ensalada Mixta",
    ingredientes: ["lechuga", "tomate", "atún"],
    instrucciones: "Lava bien la lechuga y córtala en trozos pequeños. Corta el tomate en rodajas o cubos, según prefieras. Mezcla la lechuga con el tomate en un bol grande. Añade el atún desmenuzado y mezcla suavemente. Sirve fría y, si lo deseas, aliñala con aceite de oliva y sal.",
    imagen: "img/img_recetas.png"
  },
  {
    nombre: "Arroz con Pollo",
    ingredientes: ["pollo", "arroz"],
    instrucciones: "Cocina el arroz en agua hirviendo con una pizca de sal hasta que esté tierno. Mientras tanto, corta el pollo en trozos pequeños y cocínalo en una sartén con un poco de aceite hasta que esté dorado. Mezcla el arroz cocido con el pollo en la sartén y sazona al gusto con especias como pimienta, ajo en polvo o perejil.",
    imagen: "img/img2_recetas.png"
  },
  {
    nombre: "Sandwich de Huevo y Queso",
    ingredientes: ["pan", "huevo", "queso"],
    instrucciones: "Cocina el huevo en una sartén con un poco de aceite o mantequilla, ya sea revuelto o frito, según prefieras. Toma dos rebanadas de pan y coloca una loncha de queso en una de ellas. Añade el huevo cocido encima del queso y cubre con la otra rebanada de pan. Calienta el sándwich en una sartén o sandwichera hasta que el queso se derrita.",
    imagen: "img/img3_recetas.png"
  },
  {
    nombre: "Batido de Plátano y Yogur",
    ingredientes: ["plátano", "yogur", "miel"],
    instrucciones: "Pela el plátano y córtalo en rodajas. Coloca las rodajas de plátano en una licuadora junto con el yogur y una cucharada de miel. Licúa todo hasta obtener una mezcla suave y homogénea. Sirve frío en un vaso y, si lo deseas, añade hielo para un batido más refrescante.",
    imagen: "img/img1_recetas.png"
  },
  {
    nombre: "Ensalada de Espinacas y Zanahoria",
    ingredientes: ["espinacas", "zanahoria", "pepino"],
    instrucciones: "Lava bien las espinacas y colócalas en un bol grande. Pela la zanahoria y rállala o córtala en tiras finas. Lava el pepino y córtalo en rodajas o cubos. Mezcla todos los ingredientes en el bol y aliña con aceite de oliva, vinagre y una pizca de sal.",
    imagen: "img/img4_recetas.png"
  },
  {
    nombre: "Wrap de Pavo y Queso",
    ingredientes: ["pan", "pavo", "queso"],
    instrucciones: "Toma una tortilla de pan y coloca unas lonchas de pavo y queso en el centro. Enrolla la tortilla firmemente para formar un wrap. Si lo deseas, caliéntalo en una sartén o sandwichera durante unos minutos para que el queso se derrita ligeramente.",
    imagen: "img/img5_recetas.png"
  },
  {
    nombre: "Manzana con Yogur y Almendras",
    ingredientes: ["manzana", "yogur", "almendras"],
    instrucciones: "Lava la manzana y córtala en trozos pequeños o rodajas. Coloca los trozos de manzana en un bol y añade el yogur por encima. Espolvorea almendras picadas o enteras sobre el yogur. Sirve como un postre o merienda saludable.",
    imagen: "img/img6_recetas.png"
  },
  {
    nombre: "Barritas de Avena y Miel",
    ingredientes: ["avena", "miel", "almendras"],
    instrucciones: "En un bol, mezcla la avena con la miel y las almendras picadas. Presiona la mezcla en un molde rectangular forrado con papel de horno. Hornea a 180°C durante 15 minutos o hasta que las barritas estén doradas. Deja enfriar y corta en porciones individuales.",
    imagen: "img/img7_recetas.png"
  },
  {
    nombre: "Brownie de Chocolate Saludable",
    ingredientes: ["chocolate", "avena", "miel"],
    instrucciones: "Derrite el chocolate en el microondas o al baño maría. En un bol, mezcla el chocolate derretido con la avena y la miel hasta obtener una masa homogénea. Vierte la mezcla en un molde rectangular y hornea a 180°C durante 20 minutos. Deja enfriar antes de cortar en porciones.",
    imagen: "img/img8_recetas.png"
  },
  {
    nombre: "Ensalada de Pollo y Espinacas",
    ingredientes: ["pollo", "espinacas", "zanahoria"],
    instrucciones: "Cocina el pollo a la plancha y córtalo en tiras o trozos pequeños. Lava las espinacas y colócalas en un bol grande. Pela la zanahoria y rállala o córtala en tiras finas. Mezcla todos los ingredientes en el bol y aliña con tu aderezo favorito.",
    imagen: "img/img9_recetas.png"
  },
  {
    nombre: "Smoothie Verde Detox",
    ingredientes: ["espinacas", "manzana", "pepino"],
    instrucciones: "Lava las espinacas, la manzana y el pepino. Corta la manzana y el pepino en trozos pequeños. Coloca todos los ingredientes en una licuadora junto con un poco de agua o hielo. Licúa hasta obtener una mezcla suave y homogénea. Sirve frío.",
    imagen: "img/img10_recetas.png"
  },
  {
    nombre: "Tostadas de Aguacate y Huevo",
    ingredientes: ["pan", "huevo", "queso"],
    instrucciones: "Tuesta las rebanadas de pan hasta que estén crujientes. Cocina el huevo al gusto (frito, revuelto o cocido). Coloca el huevo sobre el pan tostado y añade queso rallado por encima. Si lo deseas, puedes añadir aguacate en rodajas para un toque extra.",
    imagen: "img/img11_recetas.png"
  },
  {
    nombre: "Barritas de Chocolate y Almendras",
    ingredientes: ["chocolate", "almendras", "avena"],
    instrucciones: "Derrite el chocolate y mézclalo con la avena y las almendras picadas. Presiona la mezcla en un molde rectangular y deja enfriar en el refrigerador hasta que esté firme. Corta en porciones individuales y sirve.",
    imagen: "img/img12_recetas.png"
  }
];

// Cambios aquí: mostrar TODAS las recetas que incluyan al menos uno de los ingredientes seleccionados
document.getElementById('formAlimentos').addEventListener('submit', function (e) {
  e.preventDefault();

  const seleccionados = Array.from(document.querySelectorAll('input[type=checkbox]:checked')).map(el => el.value);

  // Filtrar recetas que tengan al menos uno de los ingredientes seleccionados
  const recetasEncontradas = recetas.filter(receta =>
    receta.ingredientes.some(ing => seleccionados.includes(ing))
  );

  const resultado = document.getElementById('resultado');

  if (recetasEncontradas.length > 0) {
    resultado.innerHTML = recetasEncontradas.map(receta => `
      <div class="receta">
        <h2>${receta.nombre}</h2>
        <img src="${receta.imagen}" alt="${receta.nombre}" class="receta-imagen">
        <p><strong>Instrucciones:</strong> ${receta.instrucciones}</p>
      </div>
    `).join('');
  } else {
    resultado.innerHTML = `<p>No se encontró ninguna receta con esos ingredientes.</p>`;
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const items = document.querySelectorAll('.carousel-item');
  const popup = document.getElementById('popup');
  const recipeTitle = document.getElementById('recipeTitle');
  const recipeImage = document.getElementById('recipeImage');
  const recipeInstructions = document.getElementById('recipeInstructions');
  const recipeIngredientes = document.getElementById('recipeIngredientes');
  const closeBtn = document.getElementById('closePopup');

  items.forEach(item => {
    item.addEventListener('click', () => {
      const name = item.getAttribute('data-name');
      const img = item.getAttribute('data-img');
      const instructions = item.getAttribute('data-instructions');
      const ingredientes = item.getAttribute('data-ingredientes');

      recipeTitle.textContent = name;
      recipeImage.src = img;
      recipeImage.alt = name;
      recipeIngredientes.innerHTML = ingredientes
        ? `<strong>Ingredientes:</strong> ${ingredientes}`
        : '';
      recipeInstructions.textContent = instructions;

      popup.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
  });

  window.addEventListener('click', e => {
    if (e.target === popup) {
      popup.style.display = 'none';
    }
  });

  // Carrusel horizontal con scroll automático en bucle infinito
  document.querySelectorAll('.carousel').forEach(function(carousel) {
    let interval = null;
    let scrollStep = 340; // Ajusta este valor al ancho de tus tarjetas + margen
    let scrollSpeed = 3000; // ms

    function autoScroll() {
      // Si está casi al final, vuelve al inicio (bucle)
      if (carousel.scrollLeft + carousel.offsetWidth >= carousel.scrollWidth - 5) {
        carousel.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        carousel.scrollBy({ left: scrollStep, behavior: 'smooth' });
      }
    }

    function startAutoScroll() {
      if (!interval) interval = setInterval(autoScroll, scrollSpeed);
    }

    function stopAutoScroll() {
      clearInterval(interval);
      interval = null;
    }

    startAutoScroll();

    // Parar al abrir popup (clic en receta)
    carousel.querySelectorAll('.carousel-item').forEach(item => {
      item.addEventListener('click', stopAutoScroll);
    });

    // Reanudar al cerrar popup
    closeBtn.addEventListener('click', startAutoScroll);
    window.addEventListener('click', e => {
      if (e.target === popup) startAutoScroll();
    });
  });
});

const btnMostrarForm = document.getElementById('mostrarForm');
const formWrapper = document.getElementById('formWrapper');

btnMostrarForm.addEventListener('click', function() {
  if (formWrapper.style.display === 'none' || formWrapper.style.display === '') {
    formWrapper.style.display = 'block';
    btnMostrarForm.textContent = 'Cerrar selección de alimentos';
  } else {
    formWrapper.style.display = 'none';
    btnMostrarForm.textContent = 'Selecciona tus alimentos';
  }
});