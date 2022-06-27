
<p>
<div class="card">
    <div class="card-header">
        Liste des crawls
    </div>
    <div class="card-body">
        <div class="container py-1">
            <div class="row">
                <div class="col-md-12 py-1">
                    <form id="searchform" name="searchform">
                        <div class="row">
                            <div id="search" class="col-md-10">
                                <div class="form-group">
                                    <label>Rechercher par URL</label>
                                    <input type="text" name="url" value="{{request()->get('url','')}}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label></label>
                                <button class='btn btn-success' style="margin-bottom: -55px;"> Rechercher <i class="fa fa-search"></i></button>
                            </div></div>
                    </form>
                    <table class="table table-default">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">URL</th>
                            <th scope="col">Status</th>
                            <th scope="col">Chemin</th>
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
                    @if(request()->get('url')) @else  {{$crawlers->links()}} @endif
                </div>
            </div>
        </div>
    </div>
</div>
</p>
