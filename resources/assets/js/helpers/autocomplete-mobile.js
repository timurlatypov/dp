import autocomplete from 'autocomplete.js';
import algolia from 'algoliasearch';

var index = algolia('K64IOX67YH', '648a56e19c5957ed4c49e89c69c69cc9')

export const productautocompletemobile = (selector, { hitsPerPage }) => {
    index = index.initIndex('products')

    return autocomplete(selector, {
        hint: true
    }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: hitsPerPage }),
        displayKey: 'title',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion._highlightResult.brand.name.value + " - " + suggestion._highlightResult.title_eng.value + " - " + suggestion._highlightResult.title_rus.value + '</span>';
            },
            empty: '<div class="p-3">Ничего не найдено</div>'
        }
    })
}