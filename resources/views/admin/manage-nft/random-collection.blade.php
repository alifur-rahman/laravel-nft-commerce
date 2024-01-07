
<div class="col-md-4 m-0 w-100 error-bottom">
    <label for="" class="form-label">Collection</label>
    <select class="form-select" name="collection" id="collection" data-control="select2"
        data-placeholder="Select a Collection">
        <option></option>
        @foreach ($user_collections as $collection)
        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
        @endforeach

    </select>
</div>
