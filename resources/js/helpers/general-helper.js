
const formatEmploymentType = (type) => {
    switch (type) {
        case 'full_time':
            return 'Pilna laika';
        case 'part_time':
            return 'Nepilna laika';
        case 'contract':
            return 'Līgumdarbs';
        case 'temporary':
            return 'Pagaidu darbs';
        default:
            return 'Nezināms';
    }
};

const formatDatePosted = (datePosted) => {
    const postedDate = new Date(datePosted);
    const currentDate = new Date();
    const differenceInTime = currentDate - postedDate;
    const differenceInDays = Math.floor(differenceInTime / (1000 * 3600 * 24));

    let postedAgoText;

    if (differenceInDays === 0) {
        postedAgoText = "Publicēts šodien";
    } else if (differenceInDays === 1) {
        postedAgoText = "Publicēts vakar";
    } else {
        postedAgoText = `Publicēts pirms ${differenceInDays} dienām`;
    }

    return postedAgoText;
};

export default {
    formatEmploymentType,
    formatDatePosted
}
