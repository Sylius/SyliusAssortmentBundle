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
        $("#sylius-assortment-option-values-adder").click(function () {
            addOptionValueForm();
        });

        addOptionValueForm();
    });

    function addOptionValueForm() {
        var collectionHolder = $("#sylius-assortment-option-values");
        var prototype = collectionHolder.attr('data-prototype');
        var newOptionValue = prototype.replace(/__name__/g, collectionHolder.children().length);
        collectionHolder.append(newOptionValue);
    }
})( jQuery );
