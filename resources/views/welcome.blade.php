<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <!-- Styles -->
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <script src="{{ asset('js/app.js') }}" defer></script>




        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>



        <div class="welcome mb-0" id="app" >
            <!-- nevbar -->
        @include('navbars.transparent')
              <br>
              <br>

            <!-- about -->
            <div class="row ml-5 m-0" >


                <div class="col-xl-6 text-center m-0" >
                    <div class="jumbotron text-white Jumbotron_Welcome">
                        <h1 style="text-align: center">
                            Everyday Amplified
                        </h1>
                        <br>
                        <h2 style="text-align: center">
                            Access anywhere, Join anytime.
                        </h2>
                        <br>
                        <h3 style="text-align: center">
                            An acoustic show is all about you, and any little nuance or mistake is amplified.
                        </h3>
                        <br>
                        <h4 style="text-align: center">
                            Ready to use? Click bellow to create your membership.
                        </h4>
                        <br>
                        <a class="btn btn-danger" style="width: 250px; font-weight: 900;" href="{{ route('register') }}">{{ __('Get Yourself Started  >>') }}</a>
                    </div>

                </div>


            </div>



        </div>

        <div class = "p-1 border-danger linear-gradient"></div>

        <!-- pakages view -->
        <div class='container-fluid grad1'>
            <br>
            <div class='container-fluid justify-content-center text-center'>
                <span class='display-4 text-white '>Pakages</span>
            </div>

            <div class="container pt-5 ">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class='jumbotron jumbotron_apnd'>
                            <div class="container text-center" >
                                <span class='h3 text-white'>Users</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center" >
                                <span class='h5 text-white'>Retailer</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center" >
                                <span class='h5 text-white'>Distributor</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class='jumbotron jumbotron_apnd'>
                            <div class="container text-center">
                                <span class='h3 text-white'>Web</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center"  >
                                <span class='h5 text-white'>RS 1200 / Mounth</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center">
                                <span class='h5 text-white'>RS 1200 / Mounth</span>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class='jumbotron jumbotron_apnd'>
                            <div class="container text-center" >
                                <span class='h3 text-white'>Web + App</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center" >
                                <span class='h5 text-white'>RS 1600 / Mounth</span>
                            </div>
                            <hr class='bg-danger'>
                            <div class="container text-center" >
                                <span class='h5 text-white'>RS 1600 / Month</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class = "p-1 border-danger linear-gradient"></div>


        <!-- Functionalities View -->
        <div class='container-fluid grad1'>
            <br>
            <div class='container-fluid justify-content-center text-center'>
                <span class='display-4 text-white '>Services</span>
            </div>
            <br>

                 <!-- First Row -->
                <div class="row">
                    <div class='jumbotron jumbotron_apnd col-md-4'>
                        <div class="container text-center" >
                            <span class='h3 text-white'>Point Of Sale</span>
                        </div>
                        <hr class='bg-danger'>
                        <div class="container text-center" >
                            <span class='text-white'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </svg>
                            </span>
                        </div>
                    </div>

                    <div class='jumbotron jumbotron_apnd col-md-4'>
                        <div class="container text-center" >
                            <span class='h3 text-white'>Online Shop</span>
                        </div>
                        <hr class='bg-danger'>
                        <div class="container text-center" >
                            <span class='text-white'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                  </svg>
                            </span>
                         </div>
                    </div>


                     <div class='jumbotron jumbotron_apnd col-md-4'>
                        <div class="container text-center" >
                            <span class='h3 text-white'>Online Transactions</span>
                        </div>
                        <hr class='bg-danger'>
                        <div class="container text-center" >
                            <span class='h5 text-white'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                                  </svg>
                            </span>
                        </div>
                    </div>

                </div>


                <!-- Second Row -->
                <div class="row justify-content-center">

                    <div class='jumbotron jumbotron_apnd col-md-4'>
                        <div class="container text-center" >
                            <span class='h3 text-white'>Reports</span>
                        </div>
                        <hr class='bg-danger'>
                        <div class="container text-center" >
                            <span class='h5 text-white'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                                  </svg>
                            </span>
                        </div>
                    </div>


                    <div class='jumbotron jumbotron_apnd col-md-4'>
                        <div class="container text-center" >
                            <span class='h3 text-white'>Inventory Managment</span>
                        </div>
                        <hr class='bg-danger'>
                        <div class="container text-center" >
                            <span class='text-white'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                                    <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                                  </svg>
                            </span>
                        </div>
                    </div>
                </div>



        </div>

        <div class = "p-1 border-danger linear-gradient"></div>



        <!-- footer -->
        @include('navbars.footer')








    </body>
</html>
