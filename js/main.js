/**
 * Point d'entrée principal du thème — importe et instancie les composants JS.
 *
 * Approche actuelle (minimale) : import direct et instanciation manuelle d'une classe.
 * À mesure que le nombre de composants JS augmente, chaque nouveau composant nécessite
 * un import + une instanciation explicite ici.
 * Voir le bloc alternatif plus bas pour un pattern qui automatise cette étape via un
 * mapping HTML → classe JS.
 */
import { Test } from "./Test.js";

new Test();

/**
 * [ALTERNATIVE — désactivée] Instanciation automatique des composants via data-attribute.
 *
 * Plutôt que d'importer et instancier chaque classe manuellement, ce pattern scanne le DOM
 * à la recherche de tout élément portant un attribut data-js-component (ex.
 * <div data-js-component="Carrousel">), puis instancie automatiquement la classe JS correspondante
 * en consultant classesMapping — un objet qui associe le nom utilisé dans le HTML (ex. "Carrousel")
 * à la classe JS importée (ex. { Carrousel: Carrousel, Accordion: Accordion }), défini dans
 * classMapping.js.
 *
 * Avantage : ajouter un composant ne demande plus qu'une entrée dans classesMapping,
 * pas une ligne d'instanciation manuelle par composant utilisé sur la page.
 *
 * IIFE (fonction auto-invoquée) : isole ce bloc de code dans son propre scope, pour éviter
 * de polluer le scope global avec les variables temporaires.
 */
/*
import { classesMapping } from './classMapping.js';


(function() {
    
    let elComponents = document.querySelectorAll('[data-js-component]');

    for (let i = 0, l = elComponents.length; i < l; i++) {

        let datasetComponent = elComponents[i].dataset.jsComponent, 			// => string
            elComponent = elComponents[i];

        for (let key in classesMapping) {
            if (datasetComponent == key) new classesMapping[datasetComponent](elComponent);
        }
    }
    
})();
*/

/**
 * [ALTERNATIVE — désactivée] Point d'entrée pour les équipes qui n'utilisent pas
 * l'approche orientée objet (classes ES6) plus haut dans ce fichier.
 *
 * Pattern classique : attend que le DOM soit entièrement chargé et parsé (DOMContentLoaded)
 * avant d'exécuter le code, puis tout le JS de la page peut être écrit directement dans ce
 * callback (fonctions, manipulation du DOM, etc.) sans passer par des classes ni des imports
 * de modules séparés.
 *
 * À utiliser comme solution de repli au bloc d'import/instanciation de classe ci-dessus — pas en plus.
 */
/*
document.addEventListener('DOMContentLoaded', () => {

    console.log('main.js');

});
*/

document.addEventListener("DOMContentLoaded", () => {
  const boutonMenu = document.querySelector(".bouton-menu");
  const menuNavigation = document.querySelector(".main-navigation");
  const boutonFermerMenu = document.querySelector(".fermer-menu");
  const requeteEcranLarge = window.matchMedia("(min-width: 768px)");
  const enteteSite = document.querySelector(".site-header");
  const formulaire = document.querySelector("#recherche-entete");
  const boutonRecherche = document.querySelector(".bouton-recherche");
  const boutonFermer = document.querySelector(".fermer-recherche-entete");
  const champRecherche = document.querySelector("#champ-recherche-entete");

  if (!menuNavigation || !boutonMenu || !boutonFermerMenu) {
    return;
  }

  function fermerMenu() {
    menuNavigation.classList.remove("ouvert");
    boutonMenu.setAttribute("aria-expanded", "false");
    document.body.classList.remove("menu-ouvert");
  }

  function actualiserEnteteAuDefilement() {
    if (!enteteSite) return;

    enteteSite.classList.toggle(
      "defile",
      requeteEcranLarge.matches && window.scrollY > 40,
    );
  }

  window.addEventListener("scroll", actualiserEnteteAuDefilement, {
    passive: true,
  });
  requeteEcranLarge.addEventListener("change", actualiserEnteteAuDefilement);
  actualiserEnteteAuDefilement();

  boutonMenu.addEventListener("click", () => {
    const vaOuvrir = !menuNavigation.classList.contains("ouvert");
    menuNavigation.classList.toggle("ouvert", vaOuvrir);
    boutonMenu.setAttribute("aria-expanded", String(vaOuvrir));
    document.body.classList.toggle("menu-ouvert", vaOuvrir);
    if (vaOuvrir) boutonFermerMenu.focus();
  });

  boutonFermerMenu.addEventListener("click", () => {
    fermerMenu();
    boutonMenu.focus();
  });

  menuNavigation.querySelectorAll("a").forEach((lien) => {
    const itemParent = lien.closest(".menu-item-has-children, .page_item_has_children");

    if (itemParent) {
      lien.setAttribute("href", "#");
      lien.setAttribute("aria-disabled", "true");
      lien.addEventListener("click", (event) => {
        event.preventDefault();
        event.stopPropagation();
      });
      return;
    }

    lien.addEventListener("click", fermerMenu);
  });

  if (!formulaire || !boutonRecherche || !boutonFermer || !champRecherche) {
    return;
  }

  // OUVRIR LA RECHERCHE
  boutonRecherche.addEventListener("click", () => {
    if (!formulaire.classList.contains("est-ouverte")) {
      formulaire.classList.add("est-ouverte");

      boutonRecherche.setAttribute("aria-expanded", "true");
      boutonRecherche.setAttribute("aria-label", "Lancer la recherche");

      champRecherche.focus();
    } else if (champRecherche.value.trim() !== "") {
      // Lancer la recherche WordPress
      formulaire.requestSubmit();
    } else {
      champRecherche.focus();
    }
  });

  // FERMER LA RECHERCHE
  boutonFermer.addEventListener("click", () => {
    formulaire.classList.remove("est-ouverte");

    boutonRecherche.setAttribute("aria-expanded", "false");
    boutonRecherche.setAttribute("aria-label", "Ouvrir la recherche");

    boutonRecherche.focus();
  });
});
