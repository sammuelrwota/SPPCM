/**
 * Point d'entrée principal du thème — importe et instancie les composants JS.
 *
 * Approche actuelle (minimale) : import direct et instanciation manuelle d'une classe.
 * À mesure que le nombre de composants JS augmente, chaque nouveau composant nécessite
 * un import + une instanciation explicite ici. 
 * Voir le bloc alternatif plus bas pour un pattern qui automatise cette étape via un
 * mapping HTML → classe JS.
 */
import { Test } from './Test.js';

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