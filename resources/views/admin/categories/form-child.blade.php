<div class="form-group category_fathers_wrap">
    <label for="level_id">Category father<em class="required">*</em></label>
    <div>
        <select class="form-control" id="parent_id" name="parent_id">
            <option value=""></option>
        @foreach ($categoryFatherOptions as $category)
                <option value="{!! $category->id !!}">{!! $category->name !!}</option>
            @endforeach
        </select>
    </div>
    <div class="text-danger d-none error-message" id="parent_id_error"></div>
</div>
