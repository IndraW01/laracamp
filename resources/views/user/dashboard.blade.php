<x-app-layout>

    <section class="dashboard my-5">
        <div class="container">
            <div class="row text-left">
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        DASHBOARD
                    </p>
                    <h2 class="primary-header ">
                        My Bootcamps
                    </h2>
                </div>
            </div>
            <div class="row my-5">
                <x-alert/>
                <table class="table">
                    <tbody>
                        @forelse ($checkouts as $checkout)
                            <tr class="align-middle">
                                <td width="18%">
                                    <img src="{{ asset('images/item_bootcamp.png') }}" height="120" alt="">
                                </td>
                                <td>
                                    <p class="mb-2">
                                        <strong>{{ $checkout->camp->title }}</strong>
                                    </p>
                                    <p>
                                        {{ $checkout->created_at->isoFormat('MMMM DD, YYYY') }}
                                    </p>
                                </td>
                                <td>
                                    <strong>${{ $checkout->camp->price }}k</strong>
                                </td>
                                <td>
                                    @if ($checkout->is_paid)
                                        <strong class="text-success">Payment Success</strong>
                                    @else
                                        <strong>Waiting for Payment</strong>
                                    @endif
                                </td>
                                <td>
                                    <a href="https://wa.me/085821559461?text=Hi, Saya ingin bertanya tentang kelas {{ $checkout->camp->title }}" class="btn btn-primary">
                                        Contact Support
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" align="center">Checkou Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-app-layout>
