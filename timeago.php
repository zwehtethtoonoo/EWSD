<?php
include_once('inc/connect.php');

$query=mysqli_query($connection,"SELECT i.ideaid,s.name, c.comment, c.commentdate 
                                FROM tblidea i, tblcomment c, tblstaff s 
                                WHERE i.ideaid=c.ideaid 
                                AND c.commenterid=s.staffid 
                                AND i.staffid='St-00001' 
                                ORDER BY c.commentdate DESC");
$row=mysqli_fetch_array($query);
$time=$row['commentdate'];

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 24 * 60 * 60            =>  'day',
                        60 * 60                 =>  'hour',
                        60                      =>  'minute',
                        1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

echo get_time_ago( strtotime("$time") );

?>