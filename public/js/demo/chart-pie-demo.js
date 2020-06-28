// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Get Products by Category Pie element
let productsByCategoryPie = $('#products-by-category-pie');

if (productsByCategoryPie.length) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/product-counted-by-category-json',
        method: 'POST',
        data: {},
        success: function (products) {

            products = JSON.parse(products);

            let data = [];
            $.each(products, function (index, product) {
                data.push(product.count);
            });

            // Pie Chart Example
            let ctx = document.getElementById("myPieChart");
            let myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Bracelets", "Charms", "Earrings", "Necklaces", "Rings", "Anklets"],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });

        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}


