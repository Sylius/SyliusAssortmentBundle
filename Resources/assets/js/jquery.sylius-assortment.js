/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function ( $ ) {
    $(document).ready(function() {
        if ($("#sylius-assortment-option-values").length > 0) {
            $("#sylius-assortment-option-values-adder").click(function () {
                addOptionValueForm();
            });

            if ($("#sylius-assortment-option-values").children().length === 0) {
                addOptionValueForm();
            }
        }

        if ($("#sylius-assortment-product-properties").length > 0) {
            $("#sylius-assortment-product-property-adder").click(function () {
                addProductPropertyForm();
            });

            if ($("#sylius-assortment-product-properties").children().length === 0) {
                addProductPropertyForm();
            }
        }
    });

    function addOptionValueForm() {
        var collectionHolder = $("#sylius-assortment-option-values");
        var prototype = collectionHolder.attr('data-prototype');
        var newOptionValue = prototype.replace(/__name__/g, collectionHolder.children().length);
        collectionHolder.append(newOptionValue);
    }
    function addProductPropertyForm() {
        var collectionHolder = $("#sylius-assortment-product-properties");
        var prototype = collectionHolder.attr('data-prototype');
        var newProductPropertyForm = prototype.replace(/__name__/g, collectionHolder.children().length);
        collectionHolder.append(newProductPropertyForm);
    }
})( jQuery );
