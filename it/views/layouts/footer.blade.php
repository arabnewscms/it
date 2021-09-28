<!-- premium contributors -->
<div id="contributors" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 65px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contributors List</h4>
            </div>
            <div class="modal-body">
                <center>
                <p>We appreciate your great efforts, so we are pleased to include your names in this list to let everyone know that there are warriors for this wonderful work, and we can only thank your great efforts in developing this package. Thank you to everyone who</p>
                <a href="https://github.com/etchfoda">
                    <img src="https://avatars.githubusercontent.com/u/15731469?v=4"
                    class="img-thumbnail rounded-circle partners"
                    title="Hesham Fouda"
                    />
                </a>

                <p>Thanks, gratitude and appreciation for their contribution and their desire to continue developing this package</p>

                </center>
            </div>
        </div>
    </div>
</div>
<!-- premium partners -->
<div id="partners" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 65px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Premium Partners (+6) (3) unknown</h4>
            </div>
            <div class="modal-body">
                <center>
                <p>From Patreon</p>
                <a href="https://www.patreon.com/user/creators?u=60188999">
                    <img src="https://c10.patreonusercontent.com/3/eyJ3IjoyMDB9/patreon-media/p/user/60188999/0d4859e2cc3f43cd96cc2ea0e1babb05/1.jpeg?token-time=2145916800&token-hash=cgXDjH8GLfNwLIU5crsasPk9aG9O5NptR_wgtAAJx4I%3D"
                    class="img-thumbnail rounded-circle partners"
                    title="Ahmed Ibrahim Jouda"
                    />
                </a>
                <a href="https://www.patreon.com/user/creators?u=59936261">
                    <img src="https://c10.patreonusercontent.com/3/eyJ3IjoyMDB9/patreon-media/p/user/59936261/28446d31df904011b9f9606f8e7bd570/1.jpeg?token-time=2145916800&token-hash=H5ef3LHy1Cnj8kD_eLpyYKajKvFTaVor976wsOkU8sk%3D"
                    class="img-thumbnail rounded-circle partners"
                    title="محمد حسن"
                    />
                </a>

                <p>Thanks, gratitude and appreciation for their contribution and their desire to continue developing this package</p>
                <p>Do you want to be with Premium Partners List?
                    <a href="#" data-toggle="modal" data-target="#donate" title="donate">
                        <i style="font-size:20px">&#9749;</i>&nbsp; {{ it_trans('it.donate') }}
                    </a>
                </p>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="donate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 65px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Donate - Me</h4>
            </div>
            <div class="modal-body">
                <p>Do you really like my work?</p>
                <p>Well that's good for me</p>
                <p>So if you are from Egypt and use this work, I am really grateful to you</p>
                <p>If you want to support me, this is something that will make me more happy because I will continue to develop this thing</p>
                <p>You can support me with a cup of coffee. that makes me feel that someone cares about me
                Well this is the phone number to send your support to me <br/> <big>(01010757170 Vodafone Cash)</big></p>
                <p>or in patreon <a href="https://www.patreon.com/phpanonymous?fan_landing=true" target="_blank">https://www.patreon.com/phpanonymous?fan_landing=true</a></p>
                <p>If you are able to encourage me, do not hesitate and support me immediately </p>
                <p>thank you &#10084;&#65039;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="">
<div class="panel panel-default">
    <div class="bs-callout bs-right-panel">
        {{--  <div class="row">
            <h3 class="text-primary">{{it_trans('it.slug')}}</h3>
        </div> --}}
        <div class="row">
            <br/>
            <p class="text-center">Copyright Reserved <a href="https://it.phpanonymous.com">it</a> &copy; {{date('Y')}}
            IT Package {{it_trans('it.version')}}{{it_version()}} ,
            <a href="#" data-toggle="modal" data-target="#partners" title="partners">
                <i class="fa fa-users"></i> {{ it_trans('it.partners') }}
            </a> ,
            <a href="#" data-toggle="modal" data-target="#contributors" title="contributors">
                <i class="fa fa-users"></i> contributors
            </a>
        </p>
    </div>
</div>
</div>
</div>
</div>
</div>
@stack('baboon_js')
</body>
</html>