@csrf
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-6">
        <div class="mb-5">
            <label for="title" class="form-label">Title :</label>
            <input id="title" type="text" name="title" value="{{ isset($post) ? $post->title : old('title') }}" class="form-control" placeholder="Post Title" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <label for="category_id" class="form-label">Category :</label>
            <select id="category_id" class="form-select" name="category_id">
                @foreach($categories as $category)
                    @if (old('category_id') == $category->id || isset($post) ?? $post->category_id == $category->id)
                        <option value="{{ $category->id }}" selected>
                            {{ $category->name }}
                        </option>
                    @else
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-5">
            <label for="excerpt" class="form-label">Excerpt (Short Description : Max 250 characters) : </label>
            <textarea id="excerpt" class="form-control"
                      name="excerpt" required>{!! isset($post) ? $post->excerpt : old('excerpt') !!} </textarea>
        </div>
        <div class="mb-5">
            <label for="content" class="form-label">Content : </label>
            <textarea style="background-color: white" id="content" class="summernote"
                      name="content" required>{!! isset($post) ? $post->content : old('content') !!} </textarea>
        </div>
    </div>
    <input type="hidden" name="slug" value="{{ isset($post) ? $post->slug : old('slug') }}" />
</div>
<div class="action-buttons">
    <button name="state" value="{{ \App\Enums\PostState::PUBLISHED }}" type="submit" onclick="return confirm('Are you sure, you want to post this blog?')" class="btn btn-success">
        <i class="fa fa-edit"></i> Post
    </button>
    @if (! isset($post))
        <button name="state" value="{{ \App\Enums\PostState::DRAFT }}" type="submit" class="btn btn-info">
            <i class="fa fa-save"></i> Save as Draft
        </button>
    @elseif(isset($post) && $post->state == \App\Enums\PostState::DRAFT)
        <button name="state" value="{{ \App\Enums\PostState::DRAFT }}" type="submit" class="btn btn-info">
            <i class="fa fa-save"></i> Save as Draft
        </button>
    @endif
</div>
