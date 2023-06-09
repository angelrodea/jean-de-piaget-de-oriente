<?php include("template/header.php");?>
    <main>
        <div class="container">
            <h1 class="mb-4">Comentarios</h1>
            <?php
                include("db/db.php");
                $query = "SELECT c.id_comentario, a.tutor, c.comentario, c.fecha FROM comentario c
                        INNER JOIN alumno a ON c.id_alumno = a.id_alumno";
                $result = $connection->query($query);

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id_comentario'];
                    $nombre = $row['tutor'];
                    $comentario = $row['comentario'];
                    $comentario = nl2br(str_replace("\\r\\n", "\n", $comentario));
                    $fecha = $row['fecha'];
            ?>
                    <div class="my-3 mb-4">
                        <div class="mb-2 row">
                            <h4 class="col-md-9">Nombre:  <?php echo $nombre ?> </h4>
                            <span class="col-md-2 pt-2 text-end"> <?php echo $fecha ?> </span>
                            <div class="col-md-1">
                                <?php if (verifySession()): ?>
                                    <form method="POST">
                                        <input type="hidden" name="id_comment" id="deleteCommentId" value="<?php echo $id ?>">
                                        <button type="button" name="delComment" class="btn text-danger" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            onclick="setCommentId(<?php echo $id ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" 
                                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 
                                                8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 
                                                5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </form>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="overflow-auto p-3 comentarios"><?php echo $comentario ?></div>
                    </div>
            <?php } ?>

            <?php if (verifySessionUser()): ?>
                <div class="text-center mb-4">
                    <button type="button" class="btn btn-dark text-uppercase" data-bs-toggle="modal" 
                    data-bs-target="#commentModal">Comentar</button>
                </div>
            <?php endif;?>

            <!-- Modal Comment -->
            <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Comentar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="db/insert_comment.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Comentario</label>
                                    <textarea class="form-control" name="comment" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" name="btnComment" class="btn btn-primary">Comentar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                ¿Seguro que deseas eliminar este comentario de forma permanente?
                            </h1>
                            <input type="hidden" id="id_comment" name="id_comment" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" name="delComment" class="btn btn-danger" onclick="deleteComment()">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include("template/footer.php");?>