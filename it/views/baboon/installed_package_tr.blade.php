<tr class="package_tr{{ $key }} {{ check_package($package_name) === null?'warning':'success' }}">
  <td>{{ $package_name }}</td>
  <td class="package_td{{ $key }}">
    @if(check_package($package_name) === null)
    {{--  <a href="#" class="btn btn-sm btn-info install_package" btn_id="{{ $key }}" package_name="{{ $package_name }}"><i class="fa fa-cloud-download-alt"></i> Download</a> --}}
    Not Installed
    @else
    installed
    @endif
  </td>
  <td>
    @if(check_package($package_name) !== null)
      {{ check_package($package_name) }}
    @else
    None
    @endif
  </td>
</tr>