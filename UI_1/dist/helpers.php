<?php
/**
 * Returns birth date from identity
 *
 * @param string $identity Identity string
 * 
 * @return \DateTime
 */
function getBirthdateFromIdentity($identity) {
    // substring identity to get bday
    $date = substr($identity, 0, 6);

    // use built-in DateTime object to work with dates
    $date = \DateTime::createFromFormat('ymd', $date);
    $now  = new \DateTime();

    // compare birth date with current date: 
    // if it's bigger bd was in previous century
    if ($date > $now) {
        $date->modify('-100 years');
    }

    return $date;
}

/**
 * Returns gender string from identity
 *
 * @param string $identity Identity string
 * 
 * @return string
 */
function getGenderFromIdentity($identity) {
    // substring gender data and convert it to int
    $gender = (int) substr($identity, 6, 1);
    return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
}

/**
 * Returns age from birthdate (on 31 December of the current year)
 *
 * @param \DateTime $birthdate Birth date
 * 
 * @return int
 */
function getAgeFromBirthday(\DateTime $birthdate) {
    $date = new DateTime();
    $interval = $date->diff($birthdate);
    return $interval->y;
}