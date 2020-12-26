<div class="mt-5 text-center">

    <h1 class="mb-5 "> Crear docente nuevo</h1>

    <form class="ml-5 text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <div class=" ml-5 justify-content-md-center ">
            <div class=" form-group row text-center ">
                <label for="codigo" class="col-sm-2 col-form-label">C&oacute;digo:</label>
                <div class="col-2">
                    <input maxlength=4 type="text" class="form-control" id="codigo" name="codigo"
                        placeholder="4 d&iacute;gitos">
                </div>
            </div>
            <div class="form-group row">
                <label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombres" name="nombres"
                        placeholder="Ingrese los nombres">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidop" class="col-sm-2 col-form-label">Apellido paterno:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="apellidop" name="apellidop"
                        placeholder="Ingrese el apellido paterno">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidom" class="col-sm-2 col-form-label">Apellido materno:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="apellidom" name="apellidom"
                        placeholder="Ingrese el apellido materno">
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-sm-2 col-form-label">Correo electr&oacute;nico:</label>
                <div class="col-md-8">
                    <input type="correo" class="form-control" id="correo" name="correo"
                        placeholder="Ingrese el correo electr&oacute;nico">
                </div>
            </div>
            <div class="form-group row">
                <label for="clave" class="col-sm-2 col-form-label">Contrase&ntilde;a:</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" id="clave" name="clave"
                        placeholder="Ingrese la contrase&ntilde;a">
                </div>
            </div>
            <div class="form-group row">
                <label for="direccion" class="col-sm-2 col-form-label">Direcci&oacute;n:</label>
                <div class="col-md-8">
                    <select name="direccion" id="direccion" class="form-control">
                        <option value="" selected hidden>...</option>
                        <option value="elec">Ing. Electr&oacute;nica</option>
                        <option value="meca">Ing. Mecatr&oacute;nica</option>
                        <option value="indu">Ing. Industrial</option>
                        <option value="ciencias">Ciencias</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="contrato" class="col-sm-2 col-form-label">Contrato:</label>
                <div class="col-md-8">
                    <select name="contrato" id="contrato" class="form-control">
                        <option value="" selected hidden>...</option>
                        <option value="staff">Staff</option>
                        <option value="contratado">Contratado</option>
                        <option value="dictante">Dictante</option>
                        <option value="parcial">Parcial</option>
                        <option value="investigador">Investigador</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="habilitado" class="col-sm-2 col-form-label">Habilitado:</label>
                <div class="col-md-8">
                    <select name="habilitado" id="habilitado" class="form-control" required>
                        <option value="" selected hidden>...</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="admin" class="col-sm-2 col-form-label">Admin:</label>
                <div class="col-md-8">
                    <select name="admin" id="admin" class="form-control" required>
                        <option value="" selected hidden>...</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>
            <div class=" form-group row text-center ">
                <label for="maxhoras" class="col-sm-2 col-form-label">M&aacute;ximo de horas:</label>
                <div class="col-2">
                    <input maxlength=2 type="text" class="form-control" id="maxhoras" name="maxhoras">
                </div>
            </div>
            <div class=" form-group row text-center ">
                <label for="minhoras" class="col-sm-2 col-form-label">M&iacute;nimo de horas:</label>
                <div class="col-2">
                    <input maxlength=2 type="text" class="form-control" id="minhoras" name="minhoras">
                </div>
            </div>
        </div>
    </form>


    <input type="checkbox" id="btn-modal">
    <label for="btn-modal" class="btn btn-dark btn-modal">
        Guardar
    </label>
    
    <div class="modal-propio">
        <div class="contenedor-modal">
            <div class="d-flex justify-content-between align-middle align-items-center">
                <h4 class="d-inline-block p-4" id="titulo-modal">&iquest;Est&aacute; seguro que quiere grabar al docente&#63;</h4>

                <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times" id="salir-modal"></i></label>
            </div>
            <hr class="p-4">
            <div class="contenido-modal p-4">
                <label class="btn btn-dark text-light" onclick="grabarDocente()">Aceptar</label>
                <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
            </div>
        </div>
    </div>
</div>