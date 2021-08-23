<div class="ibox float-e-margins">
    <div class="ibox-title widget-rounded-border-top border-bottom">
        <div class="ibumm-widget-title ">COMMISSIONS</div>
    </div>

    <div class="ibox-content widget-rounded-border-bottom dashboard_block">
        <div class="row">
            <div class="col-md-4 col-xs-12 mt-4 ml-4">
                <div class="commission_subtitle">This Week: </div>
                <a href="{{route('commission')}}">
                    <div class="commission_title_bold mb-3">${{ $dashboard['comissions']['week'] }}</div>
                </a>
                <div class="commission_subtitle">This Month:</div>
                <a href="{{route('commission')}}">
                    <div class="commission_title_bold mb-3">${{ $dashboard['comissions']['month'] }}</div>
                </a>
                <div class="commission_subtitle">This Year:</div>
                <a href="{{route('commission')}}">
                    <div class="commission_title_bold mb-3">${{ $dashboard['comissions']['year'] }}</div>
                </a>
            </div>
            <div class="col-md-6 col-xs-12 text-center d-flex aling-itens-center flex-column justify-content-center">
                <div class="commission_subtitle">EWallet Balance</div>
                <a href="{{url('e-wallet')}}">
                    <div class="commission_title_bold_bigger">${{ $dashboard['comissions']['ewallet_balance'] }}</div>
                </a>
            </div>
        </div>
    </div>
</div>
