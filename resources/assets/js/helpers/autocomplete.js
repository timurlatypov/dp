import autocomplete from 'autocomplete.js';
import algolia from 'algoliasearch';

var index = algolia('FR73EZT098', '10a2c8e639eab374e4054645135393e8')

export const productautocomplete = (selector, { hitsPerPage }) => {
    index = index.initIndex('doctorproffi_index')

    return autocomplete(selector, {
        hint: true
    }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: hitsPerPage }),
        displayKey: 'title',
        templates: {
            suggestion (suggestion) {
                console.log(suggestion)
                return '<span><a href="/brand/' + suggestion.brand.slug + '/' + suggestion.slug + '">' + suggestion._highlightResult.brand.name.value + " - " + suggestion._highlightResult.title.value + '</a></span>';
            },
            empty: '<div class="p-3">No results</div>'
        }
    })
}