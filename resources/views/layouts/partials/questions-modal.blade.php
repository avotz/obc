<!-- question Modal -->
<div class="modal fade" id="modal-questions" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Questions</h3>
                </div>
                <div class="block-content">
                    <form class="form-horizontal push-10-t" action="#" method="post" onsubmit="return false;" id="modal-questions-form">
                        <input type="hidden" name="partner" id="modal-questions-partner">
                        <input type="hidden" name="user" id="modal-questions-partner" >
                        <div class="form-group {{ $errors->has('modal_questions_subject') ? ' has-error' : '' }}">
                            <div class="col-sm-12">
                                <div class="form-material form-material-primary input-group">
                                    <input class="form-control" type="text" id="modal-questions-subject" name="modal_questions_subject" placeholder="">
                                    <label for="modal_questions_subject">Subjet</label>
                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    @if ($errors->has('modal_questions_subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('modal_questions_subject') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('modal_questions_msg') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <textarea class="form-control" id="modal-questions-msg" name="modal_questions_msg" rows="7" placeholder="Enter your message.."></textarea>
                                    <label for="modal_questions_msg">Message</label>
                                    @if ($errors->has('modal_questions_msg'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('modal_questions_msg') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group remove-margin-b">
                            <div class="col-xs-12">
                                <button class="btn btn-sm btn-primary modal-question-btn-send" type="submit"><i class="fa fa-send push-5-r"></i> Send Message</button>
                                <span class="fa fa-cog fa-spin"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
            </div>
        </div>
    </div>
</div>