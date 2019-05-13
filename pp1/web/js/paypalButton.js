var form = $(document.createElement('form'));
$(form).attr('action', 'index.php?r=car/confirm-status');
$(form).attr('method', 'POST');
$(form).css('display', 'none');

var input_employee_name = $('<input>')
    .attr('type', 'text')
    .attr('name', 'payed')
    .val(true);
$(form).append($(input_employee_name));
form.appendTo( document.body );

$(document).ready(function(){
    paypal.Buttons({
        style: {
            layout: 'horizontal',
            shape:  'pill',
            label:  'pay',
            height: 40
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '5.01'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
               $(form).submit();

            });
        },
        onCancel: function(data) {
            // Show a cancel page, or return to cart
        }
    }).render('#paypal-button-container');
});