<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
</div>
<script>
    var hostUrl = "assets/index.html";
</script>
<script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/settings/signin-methods.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/settings/profile-details.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/settings/deactivate-account.js') }}"></script>
<script src="{{ asset('/assets/js/custom/pages/user-profile/general.js') }}"></script>
<script src="{{ asset('/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/two-factor-authentication.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/list/export.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/list/list.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/add.js') }}"></script>
<script src="{{ asset('/assets/js/view_data.js') }}"></script>
<script src="{{ asset('/assets/js/status_change.js') }}"></script>
<script src="{{ asset('/assets/js/sweat@alert.js') }}"></script>
<script src="{{ asset('/assets/js/insert_data.js') }}"></script>
<script src="{{ asset('/assets/js/delete_data.js') }}"></script>
<script src="{{ asset('/assets/js/update_data.js') }}"></script>
<script src="{{ asset('/assets/js/restore_data.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@yield('script')
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
        $jq('.dataTables').DataTable({
            searching: true,
            paging: true,
            lengthMenu: [10, 25, 50, 75, 100],
            pageLength: 10
        });
        $jq('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        $jq('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    });
</script>
