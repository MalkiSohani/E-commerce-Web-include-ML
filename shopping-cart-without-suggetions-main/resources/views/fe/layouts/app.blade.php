<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/price_rangs.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    @yield('content')

    <script src="{{ asset('assets/fe/js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/fe/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('assets/fe/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/contact.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/fe/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/fe/js/stellar.js') }}"></script>
    <script src="{{ asset('assets/fe/js/price_rangs.js') }}"></script>
    <script src="{{ asset('assets/fe/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        function comment(productId) {
            $.confirm({
                title: 'Purchase Comments',
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Enter something here</label>' +
                    '<textarea placeholder="Your comment" class="comment form-control" required /></textarea>' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function() {
                            var comment = this.$content.find('.comment').val();
                            if (!comment) {
                                $.alert('Please provide comment fo purchased product');
                                return false;
                            }

                            $.ajax({
                                type: "GET",
                                url: "{{ route('order.comment') }}",
                                data: {
                                    'product': productId,
                                    'comment': comment,
                                },
                                success: function(response) {
                                    location.reload();
                                }
                            });

                        }
                    },
                    cancel: function() {
                    },
                },
                onContentReady: function() {
                    var jc = this;
                    this.$content.find('form').on('submit', function(e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click');
                    });
                }
            });
        }
    </script>
</body>

</html>
