// je récupère tous les éléments qui ont pour classe "js-admin-article-delete" (mes boutons de suppression)
// je les stocke dans une variable
const deleteArticleButtons = document.querySelectorAll('.js-admin-article-delete');

// pour chaque bouton de suppression trouvé
//deleteArticleButtons.forEach((deleteArticleButton) => {
    // on ajoute un event listener "click"
    // donc on attend que le bouton soit cliqué
    // quand il est cliqué, on execute une fonction de callback
   // deleteArticleButton.addEventListener('click', () => {

        // on prend l'élément HTML suivant (c'est à dire ici la popup)
      //  const popupTD = deleteArticleButton.closest("td");
      //  const popup = popupTD.querySelector('.popupWrapper');

        // et on l'affiche en modifiant son display en CSS
       // popup.style.display = "block";

   // });
let dataTable = new DataTable('#myTable');
console.log(dataTable)
dataTable.on('click', 'tbody tr .js-admin-article-delete', function () {
    console.log('test')
    this.closest('td').querySelector('.popupWrapper').style.display = "block"
});
