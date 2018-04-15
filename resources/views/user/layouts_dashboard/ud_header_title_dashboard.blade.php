<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{ ucfirst($data['child_nav']) }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">{{ ucfirst($data['parent_nav']) }}</a>
            </li>
            @if (!empty($data['header_title']))
              <li class="active">
                  <strong>{{ ucfirst($data['header_title']) }}</strong>
              </li>
            @else
              <li class="{{ (empty($data['header_title'])) ? "active" : "" }}">
                @if (empty($data['header_title']))
                  <strong>{{ ucfirst($data['child_nav']) }}</strong>
                @else
                  <a href='{{ url('users/'.$data['child_nav'])}}'>{{ ucfirst($data['child_nav']) }}</a>
                @endif
              </li>
            @endif
        </ol>
    </div>
    <div class="col-sm-8">
      @if (!empty($data['header_title']))
        <div class="title-action"></div>
      @else
        <div class="title-action">
          <a href="" id="add-new-item-button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add new {{ $data['child_nav']}}</a>
        </div>
      @endif
    </div>
</div>
