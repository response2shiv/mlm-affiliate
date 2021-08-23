@php
    $rankClasses = [
        14 => 'ncreaser',
        15 => 'ncreaser-500',
        16 => 'ncreaser-1000',
        17 => 'mpacter-5k',
        18 => 'mpacter-10k',
        19 => 'mpacter-20k',
        20 => 'royal-mpacter-50K',
        21 => 'royal-mpacter-100K',
        22 => 'elite-mpacter-200K',
        23 => 'elite-mpacter-500K',
        24 => 'eliteroyal-mpacter-500K',
    ];

    $packClasses =  \App\Models\Product::getEnrollmentPacks();

@endphp

@if(empty($node))
    @include ('affiliates.organization.binary_viewer.partials.open_position')
@else
    <div class="distributor-wrap
            <?php
                if($node->user->account_status == 'PENDING APPROVAL'){
                    echo 'pending-approval';
                }elseif($node->user->account_status == 'CUSTOMER'){
                    echo 'pending-approval';
                }elseif($node->user->account_status == 'CANCELLED'){
                    echo 'pending-approval';
                }elseif($node->user->account_status == 'APPROVED'){
                    echo 'active';
                }else{
                    echo 'inactive';
                }
            ?>
        {{ $rankClasses[$node->user->rank->rankid] }}
        {{ array_key_exists($node->user->current_product_id, $packClasses) ? $packClasses[$node->user->current_product_id] : 'No Product'}}"
    >
        <div class="avatar-wrap" data-href="{{ route('binaryViewer', ['id' => $node->id]) }}">
            <div class="avatar">
                <?php echo file_get_contents('./assets/images/user_btree.svg'); ?>
            </div>
            <?php
                if(array_key_exists($node->user->current_product_id, $packClasses)){
                    echo '<div class="image selected-pack">';
                    if (strpos($packClasses[$node->user->current_product_id], 'Visionary') !== false) {
                        echo '<img class="sidebar-logo" src="/assets/images/icons/Visionary_icon.png">';
                    }elseif(strpos($packClasses[$node->user->current_product_id], 'ISBO') !== false){
                        echo '<img class="sidebar-logo" src="/assets/images/icons/ISBO_icon.png">';
                    }elseif(strpos($packClasses[$node->user->current_product_id], 'FX') !== false){
                        echo '<img class="sidebar-logo" src="/assets/images/icons/FX_icon.png">';
                    }else{
                        echo '<img class="sidebar-logo" src="/assets/images/icons/Basic_icon.png">';
                    }
                    echo '</div>';
                }    
            ?>
            
            <div class="distributor-details">
                <div class="details-wrap">
                    <div class="details-title">Details</div>
                    <div class="details-row">
                        <div class="label-bviewer">NAME</div>
                        <div class="value">{{ $node->user->firstname }} {{ $node->user->lastname }}</div>
                    </div>
                    <div class="details-row">
                        <div class="label-bviewer">ISBO#</div>
                        <div class="value">{{ $node->user->distid }}</div>
                    </div>
                    <div class="details-row">
                        <div class="label-bviewer">Enrollment Date</div>
                        <div class="value">{{ $node->enrollment_date }}</div>
                    </div>
                    <div class="details-row">
                        <div class="label-bviewer">Sponsor</div>
                        <div class="value">{{ !empty($node->user) && !empty($node->user->sponsor) ? $node->user->sponsor->firstname .' '. $node->user->sponsor->lastname : 'No Sponsor' }}</div>
                    </div>
                    <div class="details-row">
                        <div class="label-bviewer">PV</div>
                        <div class="value">{{ $node->user->current_month_pqv }}</div>
                    </div>
                </div>
                <div class="horizontal-line"></div>
                <div class="sloping-line"></div>
            </div>
        </div>
        <span class="name">{{ $node->user->firstname }} {{ $node->user->lastname }}</span>
        <span class="tca-number">{{ $node->user->distid }}</span>
        <div class="vertical-line"></div>
        <div class="arc"></div>
    </div>
@endif




