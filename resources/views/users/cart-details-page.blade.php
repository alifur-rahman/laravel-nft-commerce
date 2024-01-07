@extends('layouts.users.user-layout')
@section('title', 'Cart Details')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/user/css/cart-details.css') }}">
    <style>
        .bid-content-top {
            text-align: left;
            font-size: 16px;
            margin-bottom: 15px !important;
        }

        #make_offer_date {
            font-size: 16px;
            color: #fff;
        }

        .meta_amount_input.error-msg {
            color: #ff0000ab !important;
            text-align: left !important;
            display: flex !important;
            justify-content: ;
            width: 96%;
            margin-top: 33px;
        }

        .invoice-model .table-bordered td,
        .invoice-model .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }


        .invoice-model .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .invoice-model .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        .invoice-model pre,
        .invoice-model p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        .invoice-model table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .invoice-model .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        .invoice-model td,
        .invoice-model th {
            text-align: left;
            padding: 8px 6px;
        }

        .invoice-model .table-b td,
        .invoice-model .table-b th {
            border: 1px solid #ddd;
        }

        .invoice-model td,
        .invoice-model th {
            text-align: left;
            padding: 4px 6px;
            color: #000;
        }

        .invoice-model .hm-p td,
        .invoice-model .hm-p th {
            padding: 3px 0px;
        }

        .invoice-model .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .invoice-model .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .invoice-model .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .invoice-model .table-bordered td,
        .invoice-model .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
            color: #000;
        }

        .invoice-model .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
            color: #000;
        }

        .invoice-model .invoice-items td {
            padding: 14px 0;

        }

        .placebid-modal-wrapper p {
            color: #000 !important;
            font-size: 16px;
        }

        .invoice-model tbody tr td {
            padding: 12px 4px !important;
        }

        .invoice-model.modal-body p {
            margin-bottom: 0px;
        }

        .print_box button {
            color: #000;
            padding: 10px;
            background: #0074E8;
            color: #fff;
            border-radius: 3px;
            padding-bottom: ;
            position: absolute;
            right: 9px;
            top: 9px;
            font-size: 18px;
            width: 40px;
        }


        /* reset */
        /* content editable */


        /* heading */

        .invoice_modal h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        .invoice_modal table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        .invoice_modal table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        .invoice_modal th,
        .invoice_modal td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        .invoice_modal th,
        .invoice_modal td {
            border-radius: 0.25em;
            border-style: solid;
        }

        .invoice_modal th {
            background: #EEE;
            border-color: #BBB;
        }

        .invoice_modal td {
            border-color: #DDD;
        }

        /* page */


        /* header */

        .invoice_modal header {
            margin: 0 0 3em;
        }

        .invoice_modal header:after {
            clear: both;
            content: "";
            display: table;
        }

        .invoice_modal header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        .invoice_modal header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
            text-align: left;
        }

        .invoice_modal header address p {
            margin: 0 0 0.25em;
        }

        .invoice_modal header span,
        .invoice_modal header img {
            display: block;
            float: right;
        }

        .invoice_modal header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        .invoice_modal header img {
            max-height: 100%;
            max-width: 100%;
        }

        .invoice_modal header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        .invoice_modal article,
        .invoice_modal article address,
        .invoice_modal table.meta,
        .invoice_modal table.inventory {
            margin: 0 0 3em;
        }

        .invoice_modal article:after {
            clear: both;
            content: "";
            display: table;
        }

        .invoice_modal article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        .invoice_modal article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        .invoice_modal table.meta,
        .invoice_modal table.balance {
            float: right;
            width: 36%;
        }

        .invoice_modal table.meta:after,
        .invoice_modal table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        .invoice_modal table.meta th {
            width: 40%;
        }

        .invoice_modal table.meta td {
            width: 60%;
        }

        /* table items */

        .invoice_modal table.inventory {
            clear: both;
            width: 100%;
        }

        .invoice_modal table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        .invoice_modal table.inventory td:nth-child(1) {
            width: 26%;
        }

        .invoice_modal table.inventory td:nth-child(2) {
            width: 38%;
        }

        .invoice_modal table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        .invoice_modal table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        .invoice_modal table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        .invoice_modal table.balance th,
        .invoice_modal table.balance td {
            width: 50%;
        }

        .invoice_modal table.balance td {
            text-align: right;
        }

        /* aside */

        .invoice_modal aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        .invoice_modal aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */

        .invoice_modal .add,
        .invoice_modal .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .invoice_modal .add,
        .invoice_modal .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .invoice_modal .add {
            margin: -2.5em 0 0;
        }

        .invoice_modal .add:hover {
            background: #00ADEE;
        }

        .invoice_modal .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .invoice_modal .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        .invoice_modal tr:hover .cut {
            opacity: 1;
        }

        @media print {

            .invoice_modal span:empty {
                display: none;
            }

            .invoice_modal .add,
            .invoice_modal .cut {
                display: none;
            }
        }

        .invoice_modal {
            background: #fff;
            padding: 50px;
        }

        .invoice_modal td,
        .invoice_modal th {
            text-align: center !important;
        }

        .invoice_print {
            cursor: pointer;
            padding: 4px 9px;
            background: var(--bs-primary);
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            font-weight: 500;
            position: absolute;
            right: -80px;
            top: 0;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .invoice_print:hover {
            background: #000;
            border: 1px solid var(--bs-primary);
        }
    </style>
@endsection

@section('content')
    @php
        use App\Services\AllfunctionService;
        use App\Services\likeOperactionService;
        $likeService = new likeOperactionService();
    @endphp
    <section class="cart_wrapper">
        <div class="cart_lists">
            <div class="cart_title">
                <span class="material-icons-outlined">local_mall</span>
                Your Shopping Cart
            </div>

            <div class="cart_list_wrap">
                <div class="cart_responsive"> 

                    @foreach (Cart::content() as $row)
                        @if (isset($row->id))
                            @php
                                $nft_img = AllfunctionService::get_nft_image($row->id);
                                $product_name = $row->name;
                                $product_qunatity = $row->qty;
                                $product_price = $row->price;
                            @endphp
                            <div class="tr_item item_row_{{ $row->rowId }}">
                                <div class="td_item item_img">
                                    <img src="{{ $nft_img }}" />
                                </div>
                                <div class="td_item item_name">
                                    <label class="main">{{ $product_name }}</label>
                                    <label class="sub">Ref. 007891987</label>
                                </div>
                                <div class="td_item item_color">
                                    <label>Blue</label>
                                </div>
                                <div class="td_item item_qty">
                                    <label>{{ $product_qunatity }}</label> 
                                </div>
                                <div class="td_item item_price">
                                    <label>$<span class="product_price">{{ $product_price }}</span> </label>
                                </div>
                                <div class="td_item item_remove">
                                    <a href="#" class="material-icons-outlined remove_to_card2"
                                        onclick="removeRow('{{ $row->rowId }}')">close</a>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="footer">
                    <div class="back_cart">
                        <a href="{{ route('explore') }}">
                            <span class="material-icons-outlined">west</span>
                            Back to Shop
                        </a>
                    </div>
                    <div class="subtotal">
                        <label>Subtotal: </label>
                        <strong>$<span class="subtotal_price">{{ Cart::subtotal() }}</span> </strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="cart_details">
            <div class="cart_title">
                Cart Details
            </div>
            <div class="form_row">
                <div class="form_group cart_type">
                    <label class="input_label">Select Card Type </label>

                    <input type="radio" name="cartType" required id="master" checked />
                    <label class="type master" title="Master" for="master">
                        <img src="{{ asset('assets/user/images/cart/Metamask_Fox.png') }}" alt="">
                    </label>
                </div>

                <div class="mt--0 mb--80 w-100">
                    <div class="td_item item_name d-flex justify-content-between">
                        <label class="main">Subtotal :</label>
                        <label class="sub">${{ Cart::subtotal() }}</label>
                    </div>
                    {{-- <div class="td_item item_name mt--10 d-flex justify-content-between">
                        <label class="main">Tax :</label>
                        <label class="sub">${{ Cart::tax() }}</label>
                    </div> --}}
                    <hr class="mt--20">
                    <div class="td_item item_name mt--10 d-flex justify-content-between">
                        <label class="main"><b>Total :</b></label>
                        <label class="sub">${{ Cart::subtotal() }}</label>
                    </div>
                </div>


                <button class="btn enableEthereumButton">Checkout</button>
                <button class="d-none btn click-btn-amount-modal" data-bs-toggle="modal" type="button"
                    data-bs-target="#metaMaskCheckout">Checkout</button>

            </div>

        </div>
    </section>

    <button data-bs-toggle="modal" type="button" data-bs-target="#invoice_model"
        class="invoice_model_open d-none">open</button>

    <!-- make Offer Modal -->
    <div class="rn-popup-modal placebid-modal-wrapper modal fade" id="metaMaskCheckout" tabindex="-1" aria-hidden="true">
        <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">You can buy This Product</h3>
                </div>
                <div class="modal-body text-center">
                    @if (Auth::check())
                        <p style="color: #fff !important">From Metamask</p>
                        <form class="placebid-form-box" id="buy_now_form" action="{{ route('buy_now_nft') }}"
                            method="POST">
                            @csrf
                            <div class="bid-content">
                                <div class="bid-content-top">
                                    <label for="make_value" class="d-flex">Amount: <b class="d-flex">$<span
                                                class="meta_amount"></span></b></label>
                                    <div class="bid-content-left">
                                        <input type="hidden" class="meta_amount_input" value=""
                                            name="meta_amount_val">
                                        <input type="text" value="" name="meta_amount_input">
                                        <input type="hidden" value="{{ Cart::subtotal() }}" name="total_amount">
                                        <input type="hidden" value="{{ Cart::tax() }}" name="cart_tax">
                                        <input type="hidden" value="{{ Cart::content()->count() }}" name="total_qty">
                                        @foreach (Cart::content() as $row)
                                            <input type="hidden" value="{{ $row->id }}" name="asset_id[]">
                                        @endforeach
                                        <span>wETH</span>
                                    </div>
                                    <span class="text-danger" id="bid_error"></span>
                                </div>

                            </div>
                            <div class="bit-continue-button d-flex justify-content-between mt--30">
                                {{-- <a href="#" class="btn btn-primary w-100">Place a bid</a> --}}
                                <button type="button" class="btn btn-primary-alta"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="buyNowBtn" onclick="_run(this)"
                                    data-el="fg" data-form="buy_now_form"
                                    data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                                    data-callback="buyNowCallBack" data-btnid="buyNowBtn">Buy Now</button>
                            </div>
                        </form>
                    @else
                        <p style="color:#fff !important;">But You have to loging first for Checkout</p>
                        <a href="{{ route('user.login') }}" class="btn btn-danger">Please Login For Checkout</a>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <!-- invoice template -->
    <div class="rn-popup-modal placebid-modal-wrapper modal fade invoice_model" id="invoice_model" tabindex="-1"
        aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog " style="max-width: 1100px !important">
            <div class="modal-body text-center invoice-model">

                <div class="invoice_modal" style="position: relative">
                    <span class="invoice_print" onclick="window.print()"><i class="fas fa-print"></i>&nbsp;Print</span>
                    <header>
                        <h1>Invoice</h1>
                    </header>
                    <article>
                        <h1>Recipient</h1>
                        <address style="text-align: left">
                            @if (Auth()->check())
                                @php
                                    $user_info = App\Models\UserDescription::where('user_id', auth()->user()->id)->first();
                                @endphp

                                <p>{{ auth()->user()->name }}</p>
                                <p>{{ $user_info->address }}, {{ $user_info->city }}, {{ $user_info->state }}</p>
                                <p>{{ auth()->user()->phone }}</p>
                            @endif

                        </address>
                        <table class="meta">
                            <tr>
                                <th><span>Invoice #</span></th>
                                <td><span class="invoice_number">101138</span></td>
                            </tr>
                            <tr>
                                <th><span>Date</span></th>
                                <td><span class="buy_date">{{ date('d-M-Y') }}</span></td>
                            </tr>
                        </table>
                        <table class="inventory">
                            <thead>
                                <tr>
                                    <th><span>Item</span></th>
                                    <th><span>Quantity</span></th>
                                    <th><span>Price</span></th>
                                </tr>
                            </thead>

                            <tbody class="cart_body">

                            </tbody>
                        </table>
                        <table class="balance"> 
                            <tr>
                                <th><span>Total</span></th>
                                <td><span data-prefix>$</span><span class="total_amount">600.00</span></td>
                            </tr>
                            <tr>
                                <th><span>Amount Paid</span></th>
                                <td><span data-prefix>$</span><span class="total_paid_amount">0.00</span></td>
                            </tr>
                        </table>
                    </article>
                    <aside>
                        <h1><span>Additional Notes</span></h1>
                        <div>
                            <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-js')

    <script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>
    <script>
        (function(document) {
            var
                head = document.head = document.getElementsByTagName('head')[0] || document.documentElement,
                elements =
                'article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output picture progress section summary time video x'
                .split(' '),
                elementsLength = elements.length,
                elementsIndex = 0,
                element;

            while (elementsIndex < elementsLength) {
                element = document.createElement(elements[++elementsIndex]);
            }

            element.innerHTML = 'x<style>' +
                'article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}' +
                'audio[controls],canvas,video{display:inline-block}' +
                '[hidden],audio{display:none}' +
                'mark{background:#FF0;color:#000}' +
                '</style>';

            return head.insertBefore(element.lastChild, head.firstChild);
        })(document);

        /* Prototyping
        /* ========================================================================== */

        (function(window, ElementPrototype, ArrayPrototype, polyfill) {
            function NodeList() {
                [polyfill]
            }
            NodeList.prototype.length = ArrayPrototype.length;

            ElementPrototype.matchesSelector = ElementPrototype.matchesSelector ||
                ElementPrototype.mozMatchesSelector ||
                ElementPrototype.msMatchesSelector ||
                ElementPrototype.oMatchesSelector ||
                ElementPrototype.webkitMatchesSelector ||
                function matchesSelector(selector) {
                    return ArrayPrototype.indexOf.call(this.parentNode.querySelectorAll(selector), this) > -1;
                };

            ElementPrototype.ancestorQuerySelectorAll = ElementPrototype.ancestorQuerySelectorAll ||
                ElementPrototype.mozAncestorQuerySelectorAll ||
                ElementPrototype.msAncestorQuerySelectorAll ||
                ElementPrototype.oAncestorQuerySelectorAll ||
                ElementPrototype.webkitAncestorQuerySelectorAll ||
                function ancestorQuerySelectorAll(selector) {
                    for (var cite = this, newNodeList = new NodeList; cite = cite.parentElement;) {
                        if (cite.matchesSelector(selector)) ArrayPrototype.push.call(newNodeList, cite);
                    }

                    return newNodeList;
                };

            ElementPrototype.ancestorQuerySelector = ElementPrototype.ancestorQuerySelector ||
                ElementPrototype.mozAncestorQuerySelector ||
                ElementPrototype.msAncestorQuerySelector ||
                ElementPrototype.oAncestorQuerySelector ||
                ElementPrototype.webkitAncestorQuerySelector ||
                function ancestorQuerySelector(selector) {
                    return this.ancestorQuerySelectorAll(selector)[0] || null;
                };
        })(this, Element.prototype, Array.prototype);

        /* Helper Functions
        /* ========================================================================== */

        function generateTableRow() {
            var emptyColumn = document.createElement('tr');

            emptyColumn.innerHTML = '<td><a class="cut">-</a><span  ></span></td>' +
                '<td><span  ></span></td>' +
                '<td><span data-prefix>$</span><span  >0.00</span></td>' +
                '<td><span  >0</span></td>' +
                '<td><span data-prefix>$</span><span>0.00</span></td>';

            return emptyColumn;
        }

        // function parseFloatHTML(element) {
        //     return parseFloat(element.innerHTML.replace(/[^\d\.\-]+/g, '')) || 0;
        // }

        // function parsePrice(number) {
        //     return number.toFixed(2).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,');
        // }

        /* Update Number
        /* ========================================================================== */

        function updateNumber(e) {
            var
                activeElement = document.activeElement,
                value = parseFloat(activeElement.innerHTML),
                wasPrice = activeElement.innerHTML == parsePrice(parseFloatHTML(activeElement));

            if (!isNaN(value) && (e.keyCode == 38 || e.keyCode == 40 || e.wheelDeltaY)) {
                e.preventDefault();

                value += e.keyCode == 38 ? 1 : e.keyCode == 40 ? -1 : Math.round(e.wheelDelta * 0.025);
                value = Math.max(value, 0);

                activeElement.innerHTML = wasPrice ? parsePrice(value) : value;
            }

            updateInvoice();
        }

        /* Update Invoice
        /* ========================================================================== */

        function updateInvoice() {
            var total = 0;
            var cells, price, total, a, i;

            // update inventory cells
            // ======================

            for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {
                // get inventory row cells
                cells = a[i].querySelectorAll('span:last-child');

                // set price as cell[2] * cell[3]
                price = parseFloatHTML(cells[2]) * parseFloatHTML(cells[3]);

                // add price to total
                total += price;

                // set row total
                cells[4].innerHTML = price;
            }

            // update balance cells
            // ====================

            // get balance cells
            cells = document.querySelectorAll('table.balance td:last-child span:last-child');

            // set total
            cells[0].innerHTML = total;

            // set balance and meta balance
            // cells[2].innerHTML = document.querySelector('table.meta tr:last-child td:last-child span:last-child')
            //     .innerHTML = parsePrice(total - parseFloatHTML(cells[1]));

            // update prefix formatting
            // ========================

            // var prefix = document.querySelector('#prefix').innerHTML;
            // for (a = document.querySelectorAll('[data-prefix]'), i = 0; a[i]; ++i) a[i].innerHTML = prefix;

            // update price formatting
            // =======================

            // for (a = document.querySelectorAll('span[data-prefix] + span'), i = 0; a[i]; ++i)
            //     if (document.activeElement != a[i]) a[i].innerHTML = parsePrice(parseFloatHTML(a[i]));
        }

        /* On Content Load
        /* ========================================================================== */

        function onContentLoad() {
            updateInvoice();

            var
                input = document.querySelector('input'),
                image = document.querySelector('img');

            function onClick(e) {
                var element = e.target.querySelector('[ ]'),
                    row;

                element && e.target != document.documentElement && e.target != document.body && element.focus();

                if (e.target.matchesSelector('.add')) {
                    document.querySelector('table.inventory tbody').appendChild(generateTableRow());
                } else if (e.target.className == 'cut') {
                    row = e.target.ancestorQuerySelector('tr');

                    row.parentNode.removeChild(row);
                }

                updateInvoice();
            }

            function onEnterCancel(e) {
                e.preventDefault();

                image.classList.add('hover');
            }

            function onLeaveCancel(e) {
                e.preventDefault();

                image.classList.remove('hover');
            }

            function onFileInput(e) {
                image.classList.remove('hover');

                var
                    reader = new FileReader(),
                    files = e.dataTransfer ? e.dataTransfer.files : e.target.files,
                    i = 0;

                reader.onload = onFileLoad;

                while (files[i]) reader.readAsDataURL(files[i++]);
            }

            function onFileLoad(e) {
                var data = e.target.result;

                image.src = data;
            }

            if (window.addEventListener) {
                document.addEventListener('click', onClick);

                document.addEventListener('mousewheel', updateNumber);
                document.addEventListener('keydown', updateNumber);

                document.addEventListener('keydown', updateInvoice);
                document.addEventListener('keyup', updateInvoice);

                input.addEventListener('focus', onEnterCancel);
                input.addEventListener('mouseover', onEnterCancel);
                input.addEventListener('dragover', onEnterCancel);
                input.addEventListener('dragenter', onEnterCancel);

                input.addEventListener('blur', onLeaveCancel);
                input.addEventListener('dragleave', onLeaveCancel);
                input.addEventListener('mouseout', onLeaveCancel);

                input.addEventListener('drop', onFileInput);
                input.addEventListener('change', onFileInput);
            }
        }

        window.addEventListener && document.addEventListener('DOMContentLoaded', onContentLoad);



        // exit 



        // meta mask open and amount get 
        window.addEventListener('load', function() {
            startApp();
        })
        async function startApp() {
            const provider = await detectEthereumProvider()
            if (provider) {
                window.ethereum.sendAsync({
                    method: "eth_accounts",
                    params: [],
                    jsonrpc: "2.0",
                    id: new Date().getTime()
                }, function(error, result) {
                    console.log(result);
                    if (result["result"] != "") {
                        // show model
                        const ethereumButton = document.querySelector('.enableEthereumButton');
                        ethereumButton.addEventListener('click', () => {
                            document.querySelector('.click-btn-amount-modal').click();
                            var meta_amount = 1500;
                            $('.meta_amount').html(meta_amount);
                            $('.meta_amount_input').val(meta_amount);
                        });
                    } else {
                        const ethereumButton = document.querySelector('.enableEthereumButton');
                        const showAccount = document.querySelector('.showAccount');

                        ethereumButton.addEventListener('click', () => {
                            getAccount();
                        });
                        async function getAccount() {
                            const accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            const account = accounts[0];  
                            document.querySelector('.click-btn-amount-modal').click();
                            // showAccount.innerHTML = account; 
                            var meta_amount = 1500;
                            $('.meta_amount').html(meta_amount);
                            $('.meta_amount_input').val(meta_amount);
                        }
                    }

                });

            } else {
                alert("Please install Metamask");
            }
        }


        $('#invoice_model').on('hidden.bs.modal', function(e) {
            window.location = "/destroy/cartInfo";
            setTimeout(() => {
                location.href = '/explore';
            }, 100);
        })

        // buy now call back 
        function buyNowCallBack(data) {
            if (data.status == true) {
                notify('success', data.message, 'Shoping Success!, Thank You');
                setTimeout(() => {
                    $('.invoice_model_open').click();
                }, 1000);
                $('.invoice_number').html(data.invoiceData.invoice_number);
                $('.total_amount').html(data.total_amount);
                $('.total_paid_amount').html(data.paid_amount);
                // $('.tax_amount').html(data.cart_tax);

                for (var i = 0; i < data.nftSaleData.length; i++) {
                    $('.cart_body').append(` 
                                <tr>
                                    <td><span class="product_name">` + data.nft_asset_name[i] + `</span></td>  
                                    <td><span >` + data.nftSaleData[i].quantity + `</span></td>
                                    <td><span data-prefix>$</span><span class="product_price">` + data.nftSaleData[i]
                        .total_price + `</span></td>
                                </tr>
                    `);
                }

            } else {
                notify('error', data.message, 'Checkout Failed!');
                $.validator("buy_now_form", data.errors);
            }
        }


        // print item 
        // document.getElementById("btnPrint").onclick = function() {
        //     printElement(document.getElementById("printThis"));
        // }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }

        // add to card script 

        $(document).ready(function() {
            function add_to_cart() {
                $('.add_to_card').click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var data_id = $('#data_id').val();
                    var data_name = $('#data_name').val();
                    var data_price = $('#data_price').val();
                    $.ajax({
                        method: 'POST',
                        url: '/cart',
                        dataType: 'json',
                        data: {
                            data_id: data_id,
                            data_name: data_name,
                            data_price: data_price
                        },
                        success: function(data) {
                            if (data.success == true) {
                                var cart_val_show = $('#cart_val_show').html();
                                $('#cart_val_show').html(parseInt(cart_val_show) + data.cartInfo
                                    .qty);
                                var cart_count = $('.cart_count').html();
                                $('.cart_count').html(parseInt(cart_count) + data.cartInfo
                                    .qty);
                                $('#cart_id').html(`<button type="button" class="remove_to_card btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i> 
                                                Remove to Card</button>`);
                                $('.add_to_card').hide();

                                $('#rowId').val(data.cartInfo.rowId);
                                var subtotalAmmount = $('#subtotalAmmount').html();
                                console.log(subtotalAmmount);
                                $('#subtotalAmmount').html(parseInt(subtotalAmmount) + data
                                    .cartInfo.price);
                                // product data add cart sidebar 

                                $('#product_append').append(`
                                        <li class="product" data-row-id="` + data.cartInfo.rowId +
                                    `" id="product_item_` + data.cartInfo.rowId + `">
                                            <a href="#" class="product-link">
                                                <span class="product-image">  
                                                    <img class="product_img" src="` + data.product_img + `" alt="Product Photo">
                                                </span>
                                                <span class="product-details">
                                                    <h3 class="product_name">` + data.cartInfo.name +
                                    `</h3>
                                                    <span class="qty-price">
                                                        <span class="qty"> 
                                                            <p style="font-size: 13px" >Product Quantity : <span class="product_quantity">` +
                                    data.cartInfo
                                    .qty + `</span> </p>
                                                        </span>
                                                        <span class="price product_price">` + data.cartInfo.price + `</span>
                                                    </span>
                                                </span>
                                            </a>
                                            <a href="#" data_id="` + data.cartInfo.rowId +
                                    `" class="remove-button remove_to_card remove_btn_cart_` +
                                    data.cartInfo.rowId + `"><span class="remove-icon">X</span></a>
                                        </li> 
                                    `);

                                notify('success', data.message, 'Added to Cart');
                                remove_to_cart();
                            } else {
                                notify('error', data.message, 'Added Failed!');
                            }
                        }

                    })
                })
            }

            function remove_to_cart() {
                $('.remove_to_card').click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var parentLi = $(this).parent('li');
                    if (parentLi.length != 0) {
                        var rowId = parentLi.data('row-id');
                    } else {
                        var rowId = $('#rowId').val();
                    }
                    $.ajax({
                        method: 'POST',
                        url: '/cartRemove',
                        dataType: 'json',
                        data: {
                            rowId: rowId,
                        },
                        success: function(data) {
                            if (data.success == true) {
                                var removeVal = $('#cart_val_show').html();
                                var cart_count = $('.cart_count').html();
                                $('#product_item_' + rowId).hide();
                                $('#cart_val_show').html(removeVal - 1);
                                $('.cart_count').html(cart_count - 1);
                                $('.remove_to_card').hide();
                                $('#cart_id').html(`<button type="button" class="add_to_card cart-button btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i> 
                                                Add to Card</button>`);
                                notify('success', 'Remove to Cart Succesfully!',
                                    'Remove to Cart');
                                add_to_cart();
                            } else {
                                notify('error', 'something went to wrong', 'Remove Failed!');
                            }
                        }

                    })
                })
            }

            remove_to_cart();
            add_to_cart();
        })

        function removeRow(rowId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '/cartRemove',
                dataType: 'json',
                data: {
                    rowId: rowId,
                },
                success: function(data) {
                    if (data.success == true) {
                        var removeVal = $('#cart_val_show').html();
                        var cart_count = $('.cart_count').html();
                        $('#product_item_' + rowId).hide();
                        $('#cart_val_show').html(removeVal - 1);
                        $('.cart_count').html(cart_count - 1);
                        $('.item_row_' + rowId).slideUp(500);
                        var product_price = $('.item_row_' + rowId + ' .product_price').html();
                        var subtotal_price = $('.subtotal_price').html();
                        var total = $('.subtotal_price').html(parseInt(subtotal_price) - parseInt(
                            product_price));

                        $('.remove_to_card').hide();
                        $('#cart_id').html(`<button type="button" class="add_to_card cart-button btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i> 
                                                Add to Card</button>`);
                        notify('success', 'Remove to Cart Succesfully!',
                            'Remove to Cart');
                    } else {
                        notify('error', 'something went to wrong', 'Remove Failed!');
                    }
                }

            })
        }



        function card_format(value) {
            var v = value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
            var matches = v.match(/\d{4,16}/g);
            var match = (matches && matches[0]) || "";
            var parts = [];
            for (i = 0, len = match.length; i < len; i += 4) {
                parts.push(match.substring(i, i + 4));
            }
            if (parts.length) {
                return parts.join(" ");
            } else {
                return value;
            }
        }

        // document.getElementById("card_number").oninput = function() {
        //     this.value = card_format(this.value);
        // };

        function ex_format(value) {
            var v = value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
            var matches = v.match(/\d{2,4}/g);
            var match = (matches && matches[0]) || "";
            var parts = [];
            for (i = 0, len = match.length; i < len; i += 2) {
                parts.push(match.substring(i, i + 2));
            }
            if (parts.length) {
                return parts.join(" / ");
            } else {
                return value;
            }
        }

        function checkDigit(event) {
            var code = event.which ? event.which : event.keyCode;

            if ((code < 48 || code > 57) && code > 31) {
                return false;
            }

            return true;
        }
    </script>
@endsection
