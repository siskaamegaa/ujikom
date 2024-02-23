<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Admin One Tailwind CSS Admin Dashboard</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }} ">
    <!-- Tailwind is included -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-130795909-1');
    </script>

</head>

<body>

    <nav id="navbar-main" class="navbar is-fixed-top">
        <div class="navbar-brand">
            <a class="navbar-item mobile-aside-button">
                <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
            </a>
            <div class="navbar-item">
                <h1 class="text-2xl"><b> {{ Auth::user()->name }} </b></h1>
            </div>
        </div>
        <div class="navbar-brand is-right">
            <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
                <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
            </a>
        </div>
        <div class="navbar-menu" id="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item dropdown has-divider has-user-avatar">
                    <a class="navbar-link">
                        <div class="user-avatar">
                            <img src="https://avatars.dicebear.com/v2/initials/john-doe.svg" alt="John Doe"
                                class="rounded-full">
                        </div>
                        <div class="is-user-name"><span> {{ Auth::user()->email }}</span></div>
                        <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('actionlogout') }}">
                            <span class="icon"><i class="mdi mdi-logout"></i></span>
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <aside class="aside is-placed-left is-expanded">
        <div class="aside-tools">
            <div>
                Admin <b class="font-black">One</b>
            </div>
        </div>
        <div class="menu is-menu-main">
            <p class="menu-label">General</p>
            <ul class="menu-list">
                <li class="active">
                    <a href="{{ route('home') }}">
                        <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
                        <span class="menu-item-label">Dashboard</span>
                    </a>
                </li>
            </ul>
            <p class="menu-label">Menu</p>
            <ul class="menu-list">
                <li class="--set-active-profile-htm">
                    <a href="{{ route('barang.index') }}">
                        <span class="icon"><i class="mdi mdi-table"></i></span>
                        <span class="menu-item-label">Barang</span>
                    </a>
                </li>
                <li class="--set-active-profile-html">
                    <a href="profile.html">
                        <span class="icon"><i class="mdi mdi-account-circle"></i></span>
                        <span class="menu-item-label">User</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>

    <section class="section main-section">
        <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-plus-box-outline"></i></span>
                    Tambah Data Transaksi
                </p>

            </header>
            <div class="card-content">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <div class="field-body">
                            <div class="field">
                                <!-- <div class="control icons-left">
                  <input class="input" type="text" placeholder="Merk" name="merk" >
                  <span class="icon left"><i class="mdi mdi-label-outline"></i></span>
                </div> -->

                                <select name="barang" id="barang" class="input"
                                    onchange='updateInput(document.getElementById("barang").value)'>
                                    <option value="">-- Barang --</option>
                                    @foreach ($Barangs as $barang)
                                        <option value="{{ $barang->id_barang }}">
                                            {{ $barang->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>
                                </select>
                            </div>
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="number" placeholder="Harga" name="harga"
                                        id="harga" readonly>
                                    <span class="icon left"><i class="mdi mdi-coins"></i></span>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="number" placeholder="Total Item" name="total_item"
                                        id='qty' onchange='updatetHarga(document.getElementById("harga").value)'
                                        type="number" placeholder="Qty" value='1'>
                                    <span class="icon left"><i class="mdi mdi-coins"></i></span>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="readonly" placeholder="total_harga" id='tharga'
                                        value='' name="total_harga" readonly>
                                    <span class="icon left"><i class="mdi mdi-coins"></i></span>
                                </div>
                            </div>
                            <select name="status_pembayaran" class="input">
                                <option value="">-- Status Pembayaran --</option>
                                <option value="selesai">Selesai</option>
                                <option value="belum selesai">Belum Selesai</option>
                            </select>
                            </select>

                        </div>
                    </div>
                    <div class="field grouped">
                        <div class="control">
                            <button type="submit" class="button green">
                                Submit
                            </button>
                        </div>
                        <div class="control">
                            <button type="reset" class="button red">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <script type="text/javascript" src="{{ URL::asset('js/main.min.js') }} "></script>
    <script>
        function updatetHarga(input) {
            document.getElementById("tharga").value = input * document.getElementById("qty").value;
        }

        function updateInput(input) {
            var barang = @json($Barangs);
            for (let i = 0; i < barang.length; i++) {
                if (barang[i].id_barang == input) {
                    document.getElementById("harga").value = barang[i].harga;
                    updatetHarga(document.getElementById("harga").value = barang[i].harga);
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>

</html>