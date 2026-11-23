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
  const superpositionRecherche = document.querySelector(
    "#superposition-recherche",
  );
  const fondRecherche = document.querySelector(".fond-recherche");
  const panneauRecherche = document.querySelector(".panneau-recherche");
  const champRechercheOverlay = document.querySelector("#champ-recherche");
  const boutonFermerRechercheOverlay =
    document.querySelector(".fermer-recherche");

  if (!menuNavigation || !boutonMenu || !boutonFermerMenu) {
    return;
  }

  function fermerMenu() {
    menuNavigation.classList.remove("ouvert");
    boutonMenu.setAttribute("aria-expanded", "false");
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
    if (vaOuvrir) boutonFermerMenu.focus();
  });

  boutonFermerMenu.addEventListener("click", () => {
    fermerMenu();
    boutonMenu.focus();
  });

  menuNavigation.addEventListener("click", (event) => {
    const lien = event.target.closest("a");
    if (!lien) return;

    const itemParent = lien.closest(".menu-item-has-children, .page_item_has_children");

    if (itemParent && lien.parentElement === itemParent) {
      event.preventDefault();
      event.stopImmediatePropagation();

      if (!requeteEcranLarge.matches) {
        const sousMenu = itemParent.querySelector(":scope > .sub-menu");
        const vaOuvrir = !itemParent.classList.contains("sous-menu-ouvert");

        menuNavigation.querySelectorAll(".menu-item-has-children.sous-menu-ouvert, .page_item_has_children.sous-menu-ouvert").forEach((item) => {
          if (item !== itemParent) {
            item.classList.remove("sous-menu-ouvert");
            item.querySelector(":scope > .sub-menu")?.classList.remove("ouvert");
            item.querySelector(":scope > a")?.setAttribute("aria-expanded", "false");
          }
        });

        itemParent.classList.toggle("sous-menu-ouvert", vaOuvrir);
        sousMenu?.classList.toggle("ouvert", vaOuvrir);
        lien.setAttribute("aria-expanded", String(vaOuvrir));
      }
      return;
    }

    if (!lien.closest(".sub-menu")) {
      fermerMenu();
    }
  }, true);

  menuNavigation
    .querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a")
    .forEach((lien) => {
      lien.removeAttribute("href");
      lien.setAttribute("role", "button");
      lien.setAttribute("tabindex", "0");
      lien.setAttribute("aria-haspopup", "true");
      lien.setAttribute("aria-disabled", "true");
    });

  if (!formulaire || !boutonRecherche || !boutonFermer || !champRecherche) {
    return;
  }

  function basculerRecherche(ouvrir) {
    const estMobile = window.matchMedia("(max-width: 767px)").matches;

    if (estMobile && superpositionRecherche) {
      superpositionRecherche.classList.toggle("ouverte", ouvrir);
      superpositionRecherche.setAttribute("aria-hidden", String(!ouvrir));
      document.body.classList.toggle("recherche-ouverte", ouvrir);

      if (ouvrir) {
        menuNavigation.classList.remove("ouvert");
        boutonMenu.setAttribute("aria-expanded", "false");
        champRechercheOverlay?.focus();
      }

      return;
    }

    formulaire.classList.toggle("est-ouverte", ouvrir);
    document.body.classList.remove("recherche-ouverte");

    boutonRecherche.setAttribute("aria-expanded", String(ouvrir));
    boutonRecherche.setAttribute(
      "aria-label",
      ouvrir ? "Lancer la recherche" : "Ouvrir la recherche",
    );

    if (ouvrir) {
      menuNavigation.classList.remove("ouvert");
      boutonMenu.setAttribute("aria-expanded", "false");
      champRecherche.focus();
    }
  }

  // OUVRIR LA RECHERCHE
  boutonRecherche.addEventListener("click", () => {
    const estMobile = window.matchMedia("(max-width: 767px)").matches;

    if (estMobile) {
      basculerRecherche(true);
      return;
    }

    if (!formulaire.classList.contains("est-ouverte")) {
      basculerRecherche(true);
    } else if (champRecherche.value.trim() !== "") {
      formulaire.requestSubmit();
    } else {
      champRecherche.focus();
    }
  });

  // FERMER LA RECHERCHE
  boutonFermer.addEventListener("click", () => {
    basculerRecherche(false);
    boutonRecherche.focus();
  });

  fondRecherche?.addEventListener("click", () => basculerRecherche(false));
  boutonFermerRechercheOverlay?.addEventListener("click", () =>
    basculerRecherche(false),
  );
  panneauRecherche?.addEventListener("submit", (event) => {
    if (!champRechercheOverlay?.value.trim()) {
      event.preventDefault();
      champRechercheOverlay.focus();
    }
  });
});

//Changer la position du titre selon la largeur de l'écran
console.log("Allo");

const titreMobile = document.getElementById("mobile-titre");
const titreDesktop = document.getElementById("desktop-titre");

if (titreDesktop && titreMobile) {
  titreDesktop.addEventListener("click", function () {
    console.log("desktop");
  });

  function gererAffichageTitre() {
    if (window.innerWidth >= 1024) {
      titreDesktop.classList.remove("hidden");
      titreMobile.classList.add("hidden");
    } else {
      titreDesktop.classList.add("hidden");
      titreMobile.classList.remove("hidden");
    }
  }

  // Exécuter au chargement et à chaque redimensionnement
  gererAffichageTitre();
  window.addEventListener("resize", gererAffichageTitre);
}
