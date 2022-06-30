<x-app-layout>
    <div class="container">
        <div class="row mt-5">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        <x-alert/>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">User</th>
                                <th scope="col">Camp</th>
                                <th scope="col">Price</th>
                                <th scope="col">Register Date</th>
                                <th scope="col">Paid Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($checkouts as $checkout)
                                    <tr>
                                        <td>{{ $checkout->user->name }}</td>
                                        <td>{{ $checkout->camp->title }}</td>
                                        <td>Rp. {{ number_format($checkout->camp->price, 3) }}</td>
                                        <td>{{ $checkout->created_at->isoFormat('MMM DD YYYY') }}</td>
                                        <td>
                                            @if ($checkout->is_paid)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$checkout->is_paid)
                                                <form action="{{ route('admin.checkout.update', ['checkout' => $checkout]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Set to Paid</button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-secondary btn-sm text-dark">Success</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Camps Registered</td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
