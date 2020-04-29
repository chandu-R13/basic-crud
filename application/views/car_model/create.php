<form action="" method="post" id="createCarModel" name="createCarModel">
<div class="modal-body">
    <div class="form-group">
        <label>Name</label>  
        <input type="text" name="name" id="name" value="" class="form-control" placeholder="Name">
        <p class="nameError"></p>
    </div>    
    <div class="form-group">
        <label>Color</label>  
        <input type="text" name="color" id="color" value="" class="form-control" placeholder="Color">
        <p class="colorError"></p>
    </div>    
    <div class="form-group">
        <label>Transmission</label>  
        <select id="transmission" name="transmission" class="form-control">
            <option value="Automatic">Automatic</option>
            <option value="Manual">Manual</option>
        </select>
    </div>    
    <div class="form-group">
        <label>Price</label>  
        <input type="text" name="price" id="price" value="" class="form-control" placeholder="Price">
        <p class="priceError"></p>
    </div>        
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>