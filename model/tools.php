<?php
function convertDate ($inputdate) {
	return date("d-m-y",strtotime($inputdate));
}