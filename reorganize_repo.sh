#!/bin/bash
# reorganize_repo.sh
# شغّله من جوه فولدر الريبو نفسه (web-project) على جهازك.
# اتأكد إن working directory نضيف (git status ميبينش تعديلات معلقة) قبل التشغيل.

set -e  # يوقف السكريبت فورًا لو أي أمر فشل، عشان محدش يكمل على وضع نص متعدل

echo "== 1) تأكيد إنك جوه ريبو git =="
git rev-parse --is-inside-work-tree > /dev/null || { echo "مش جوه ريبو git! ادخل فولدر web-project الأول."; exit 1; }

echo "== 2) حذف الفولدر المكرر (leftover قديم، متأكد مفيش لينكات ليه) =="
git rm -r "home_page/game page (haitham)"

echo "== 3) حذف ملفات الجذر القديمة (استُبدلت بنسخ أحدث جوه game page) =="
git rm "sign.html" "sign.css" "game.css"

echo "== 4) حذف الصور غير المستخدمة نهائيًا =="
git rm "Grand_Theft_Auto_V.png" "background_shoppingcart.jpg" "daysgone.jpg" \
       "fifa24.jpg" "gtav.jpg" "im5.jpg" "r6_game.jpg" "repopic.jpg" "valorant.jpg"

echo "== 5) إنشاء بنية الفولدرات الجديدة =="
mkdir -p assets/images assets/videos

echo "== 6) نقل det.html + الصور المرتبطة بيه لمكان منظم، وتحديث روابطه =="
mkdir -p pages/game-details
git mv det.html pages/game-details/details.html
git mv style.css pages/game-details/details.css
git mv v.jpg va.jpg val.jpg assets/images/

# تحديث الروابط جوه details.html عشان تشاور على المكان الجديد
sed -i 's|href="style.css"|href="details.css"|' pages/game-details/details.html
sed -i 's|src="v.jpg"|src="../../assets/images/v.jpg"|' pages/game-details/details.html
sed -i 's|src="va.jpg"|src="../../assets/images/va.jpg"|' pages/game-details/details.html
sed -i 's|src="val.jpg"|src="../../assets/images/val.jpg"|' pages/game-details/details.html
sed -i 's|home_page/home_page.html|../../home_page/home_page.html|' pages/game-details/details.html
sed -i "s|Shopping_Cart (M)/1.html|../../Shopping_Cart (M)/1.html|g" pages/game-details/details.html

echo "== 7) تحديث الروابط اللي كانت بتشاور على det.html القديم =="
grep -rl '\.\./det\.html' --include="*.html" . | while read f; do
  sed -i 's|\.\./det\.html|../pages/game-details/details.html|' "$f"
done

echo "== انتهى بنجاح. راجع النتيجة بـ: git status =="
echo "لو كل حاجة تمام: git commit -m \"Clean up repo structure: remove orphaned files, organize game-details page\""
echo "بعدين: git push"
