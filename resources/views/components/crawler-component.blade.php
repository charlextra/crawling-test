<div class="container">
    <p>
        <div class="card">
            <div class="card-header">
                Liste des crawls
            </div>
            <div class="card-body">
                <div class="container py-1">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <table class="table table-default">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Path</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($crawlers as $crawl)
                                    <tr>
                                        <th scope="row">{{ $crawl->id }}</th>
                                        <td>{{ $crawl->url }}</td>
                                        <td>{{ $crawl->status }}</td>
                                        <td><a href="{{url($crawl->path ? $crawl->path : '')}}">{{ $crawl->path ? $crawl->path : '' }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $crawlers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </p>
</div>