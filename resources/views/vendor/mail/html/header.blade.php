<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) == 'SIKPGAP')
            <img src="https://media-exp1.licdn.com/dms/image/C560BAQFwgXHpeRCWoQ/company-logo_200_200/0/1519897714706?e=2147483647&v=beta&t=uSr1iyMytpgBKpMJFhPOwst6vtSJkIkpi0hHn7ZpHyU"
                class="logo" alt="SIKPGAP">
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
