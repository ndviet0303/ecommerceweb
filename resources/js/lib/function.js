
export function useFunction() {

    function getExpirType(value, productType) {
        return Object.keys(productType).find(key => productType[key] === value) || 'Không xác định';
    }

    return {
        getExpirType,
    };
}
