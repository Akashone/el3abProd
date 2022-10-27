<!-- Add or update games Modal -->
<div class="modal fade" id="addNewGame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new game</h5>
                <button type="button" class="close closeModal" data-modalname="addNewGame" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewGameForm">
                    <input type="hidden" name="mode" id="mode" value="add">
                    <input type="hidden" name="id" id="id" value="0">
                    <div>
                        <label for="name">Name : </label>
                        <input type="text" name="name" id="name">
                        <strong id="gamenamevalidation" style="color: red;"></strong>
                    </div>
                    <div id="gamevalidations">
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-modalname="addNewGame">Close</button>
                <button type="button" class="btn btn-primary addOrUpdateGameToDb">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Add or update questions Modal -->
<div class="modal fade" id="addNewQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new question</h5>
                <button type="button" class="close closeModal" data-modalname="addNewQuestion" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewQuestionForm">
                    <input type="hidden" name="mode" id="mode" value="add">
                    <input type="hidden" name="id" id="id" value="0">
                    <div>
                        <label for="name">Name : </label>
                        <input type="text" name="name" id="name">
                        <strong id="quenamevalidation" style="color: red;"></strong>
                    </div>
                    <div id="quevalidations">
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-modalname="addNewQuestion">Close</button>
                <button type="button" class="btn btn-primary addOrUpdateQuestionToDb">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Add or update options Modal -->
<div class="modal fade" id="addNewOption" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Option</h5>
                <button type="button" class="close closeModal" data-modalname="addNewOption" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewOptionForm">
                    <input type="hidden" name="mode" id="mode" value="add">
                    <input type="hidden" name="id" id="id" value="0">
                    <div>
                        <label for="name">Name : </label>
                        <input type="text" name="name" id="name">
                        <strong id="optionnamevalidation" style="color: red;"></strong>
                    </div>
                    <div>
                        <label for="point">Point : </label>
                        <input type="text" name="point" id="point">
                        <strong id="optionpointvalidation" style="color: red;"></strong>
                    </div>
                    <div id="optionvalidations">
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-modalname="addNewOption">Close</button>
                <button type="button" class="btn btn-primary addOrUpdateOptionToDb">Save changes</button>
            </div>
        </div>
    </div>
</div>
