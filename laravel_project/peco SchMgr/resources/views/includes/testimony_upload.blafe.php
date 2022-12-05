<div class="row" id="pix1" >
                    <div class="form-group col-md-6">
                        <label for="title"
                            class="col-md-5 col-form-label text-md-left"> Image Caption </label>

                        <div class="col-md-12">

                            <input id="title" type="text"
                                class="form-control @error("title") is-invalid @enderror name="title"
                                value={{ old("title") }} required>

                            @error("title")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="type"
                            class="col-md-5 col-form-label text-md-left"> Pix Category </label>

                        <div class="col-md-12">
                            <select id="type" name="type" required=""
                                class="form-control  custom-select @error("type") is-invalid @enderror">
                                <option value="1"> Gallery Pix </option>
                                <option value="2"> Slides Pix </option>
                                <option value="3"> Events Pix </option>
                            </select>

                            @error("type")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="desc"
                            class="col-md-8 col-form-label text-md-left"> Write Up </label>

                        <div class="col-md-12">
                            <textarea name="desc" id="desc" class="form-control @error("desc") is-invalid @enderror"
                                rows="1" required>{{ old("desc") }}</textarea>

                            @error("desc")
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pix"
                            class="col-md-8 col-form-label text-md-left"> Image </label>
                        <div class="col-md-12">
                            <input type="file" id="pix" accept="image/*" name="pix" class="" />
                            @error("pix")
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>