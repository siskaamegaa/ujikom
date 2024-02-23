<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Admin One Tailwind CSS Admin Dashboard</title>


    <!-- Tailwind is included -->
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }} ">
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
                <li class="--set-active-index-html">
                    <a href="barang">
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


    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Data Transaksi
            </h1>
            <a href="{{ route('transaksi.create') }}" class="button light">Tambah Transaksi</a>
        </div>
    </section>

    <section class="section main-section">
        <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                    Transaksi
                </p>

            </header>
            <div class="card-content">
                <table>
                    <thead>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Transaksi</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($Transaksis as $transaksi)
                            <tr>
                                <td data-label="id_transaksi">{{ $transaksi->id_transaksi }}</td>
                                <td data-label="nama_item">{{ $transaksi->barang->nama_produk }}</td>
                                <td data-label="total_item">{{ $transaksi->total_item }}</td>
                                <td data-label="total_harga">{{ $transaksi->total_harga }}</td>
                                <td data-label="status_pembayaran">{{ $transaksi->status_pembayaran }}</td>
                                <td data-label="Created">
                                    <small class="text-gray-500"
                                        title="Oct 25, 2021">{{ $transaksi->created_at }}</small>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('transaksi.destroy', $transaksi->id_transaksi) }}"
                                        method="POST">
                                        <a href="{{ route('nota', $transaksi->id_transaksi) }}"
                                            class="button small green --jb-modal" type="button"">
                                            <span class="icon"><i class="mdi mdi-printer"></i></span>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="button small red --jb-modal" type="submit">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <div class="card empty">
                                    <div class="card-content">
                                        <div>
                                            <span class="icon large"><i
                                                    class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                                        </div>
                                        <p>Nothing's here…</p>
                                    </div>
                                </div>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>

    <script type="text/javascript" src="{{ URL::asset('js/main.min.js') }} "></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


</body>

</html>